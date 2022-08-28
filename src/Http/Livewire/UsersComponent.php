<?php

namespace Gnumarquez\Http\Livewire;

use Livewire\Component;
use Gnumarquez\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersComponent extends Component
{
	public $items =[];
	public $quantity;
	public $user_id = 0;
	public $muestra = false;
	public $roles = [];
	public $name;
	public $email;
	public $pass;
	public $role;

	public function render()
	{
		$this->roles = Role::all();
		$this->items = User::select("id","name","email")->get();
		$this->quantity = count($this->items);

		return view("mastercomponents::livewire.users-component")
		->extends('layouts.app')
		->section("content");
	}

	public function addUser()
	{

        if ($this->user_id==0){
        	$this->validate([
	            'name' => 'required|min:3',
	            'role' => 'required',
	            'pass' => 'required|min:4',
	            'email' => 'required|email|unique:users',
	        ]);
        	$user = new User();	
        } else {
        	$this->validate([
	            'name' => 'required|min:3',
	            'role' => 'required',
	        ]);
        	$user = User::find($this->user_id);
        }
		
		$user->name = $this->name;
		$user->email = $this->email;
		if (!empty($this->pass))
		{
			$user->password = Hash::make($this->pass);
		}
		$user->save();

		$user->syncRoles($this->role);
		$this->name = "";
		$this->email = "";
		$this->pass = "";
		$this->emit("closeModal");
		$this->emit("toastrs",$this->user_id==0 ? "Usuario creado":"Usuario actualizado");
	}

	public function destroy(User $user)
	{	
		if ($user->id == Auth::id())
		{
			$this->emit("toastre","No se puede eliminar usted mismo.");
		} 
		else 
		{
			$user->delete();
			$this->emit("toastrs","Usuario eliminado.");
		}
		
	}

	public function setId($id)
	{
		$this->user_id = $id;
		$user = User::find($id);
		$this->name = $user->name;
		$this->email = $user->email;
		$this->role = $user->getRoleNames()[0] ?? "";
	}

	
}
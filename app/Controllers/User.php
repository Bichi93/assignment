<?php

namespace App\Controllers;

use App\Entities\User as EntitiesUser;
use CodeIgniter\HTTP\Request;
use App\Models\UserModel;

class User extends BaseController
{
	public function create()
	{
		$userModel = new UserModel();
		$users = $userModel->findAll();

		return view('add_user', compact('users'));
	}

	public function store()
	{
		$errors = $this->validateRequest($this->request);

		if (!count($errors)) {

			$request_data = $this->request->getRawInput();

			$user = new UserModel();
			$createdId  = $user->insert($request_data);

			$selectedUser = $user->find($createdId);

			$html =    '<tr id="tr-' . $selectedUser->id . '">';
			$html .= '<td>' . $selectedUser->id . '</td>';
			$html .=  '<td>' . $selectedUser->name . '</td>';
			$html .=  '<td>' . $selectedUser->last_name . '</td>';
			$html .=  '<td>' . $selectedUser->email . '</td>';
			$html .=  '<td>' . $selectedUser->phone . '</td>';
			$html .=  '<td class="text-center">
					<a  data-target="#tr-' . $selectedUser->id . '" data-message-container="#table-message-list" data-href="' . base_url('/user/destroy/' . $selectedUser->id) . '" class="btn btn-danger delete-btn"> Delete</a>
				</td>';
			$html .=  '</tr>';

			return $this->response->setStatusCode(200)->setJSON([
				'message' => 'created successfully',
				'view' => $html
				]);

		} else {

			return $this->response->setStatusCode(400)->setJSON(['errors' => $errors]);
		}
	}

	public function destroy($id)
	{
		$userModel = new UserModel();

		$user = $userModel->find($id);
		if ($user) {
			$userModel->delete($id);
			return  $this->response->setBody('deleted successfully');
		} else {
			return $this->response->setStatusCode(400)->setJSON(['errors' => 'user not found']);
		}
	}

	public static function validateRequest($request)
	{
		$validation =  \Config\Services::validation();

		$validation->setRules([
			'name' => 'required|min_length[3]|max_length[128]',
			'last_name'  => 'required|min_length[3]|max_length[128]|string',
			'email'  => 'required|valid_email',
			'phone'  => 'required|numeric'
		]);

		$validation->withRequest($request)->run();
		return $validation->getErrors();
	}
}

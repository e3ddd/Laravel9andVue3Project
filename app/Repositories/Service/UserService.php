<?php

namespace App\Repositories\Service;

use App\Repositories\UserRepository;

class UserService extends UserRepository
{
  public function getAll()
  {
      return $this->get()->all();
  }

  public function findUser($id)
  {
      return $this->get()->find($id);
  }

  public function createUser($data)
  {
      $user = $this->get();
      $user->fill($data);
      $user->save();
  }

  public function deleteUser($id)
  {
      $this->get()->destroy($id);
  }
}

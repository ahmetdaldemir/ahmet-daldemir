<?php


namespace App\Repositories\Customer;


interface CustomerInterface
{

    public function all();

    public function create(array $data);

    public function update(array $data);

    public function delete($id);

    public function find($id);
}

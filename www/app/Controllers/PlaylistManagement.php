<?php namespace App\Controllers;

use App\Models\PlaylistModel;
use CodeIgniter\RESTful\ResourceController;

class PlaylistManagement extends ResourceController {
    protected $modelName = 'App\Models\PlaylistModel';

    public function update($id = null) {
        $data = $this->request->getJSON();
        $this->model->update($id, ['name' => $data->name]);
        return $this->respondUpdated();
    }

    public function delete($id = null) {
        $this->model->delete($id);
        return $this->respondDeleted();
    }
}
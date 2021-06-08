<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();
    public function query();
    public function find($id);
    public function search($keyword);
    public function getCategories();
    public function show($id);
    public function index($keyword);
    public function create(array $attributes);
    public function update($id, $attributes);
    public function delete($id);

    // Avatar Image
    public function getImageDirectory();
    public function getFileNameWithoutExtension($originalFileName, $extensionFileName);
    public function isExistedFile($originalFileName);
    public function createUniqueFileName($originalFileName, $extensionFileName);
    public function getOldImagePath($id);
    public function uploadImage($hasFile, $file);
    public function removeImage($path);
    public function updateImagePath($requestHasFile, $requestFile, $id);
    public function getDescription($oldDescription, $request, $path);
}

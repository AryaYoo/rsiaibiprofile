<?php

namespace App\Services;

use App\Repositories\Interfaces\DoctorRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class DoctorService
{
    protected $doctorRepository;

    public function __construct(DoctorRepositoryInterface $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    public function getAllDoctors($perPage = null)
    {
        return $this->doctorRepository->all($perPage);
    }

    public function getActiveDoctors()
    {
        return $this->doctorRepository->getActiveDoctors();
    }

    public function storeDoctor(array $data, $image = null)
    {
        if ($image) {
            $data['image'] = $image->store('doctors', 'public');
        }

        return $this->doctorRepository->create($data);
    }

    public function updateDoctor($id, array $data, $image = null)
    {
        $doctor = $this->doctorRepository->find($id);

        if ($image) {
            // Delete old image
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }
            $data['image'] = $image->store('doctors', 'public');
        }

        return $this->doctorRepository->update($id, $data);
    }

    public function deleteDoctor($id)
    {
        $doctor = $this->doctorRepository->find($id);
        
        if ($doctor->image) {
            Storage::disk('public')->delete($doctor->image);
        }

        return $this->doctorRepository->delete($id);
    }

    public function getDoctorById($id)
    {
        return $this->doctorRepository->find($id);
    }
}

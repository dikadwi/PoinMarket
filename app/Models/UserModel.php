<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Entities\User;

/**
 * @method User|null first()
 */
class UserModel extends Model
{
    protected $table          = 'users';
    protected $primaryKey     = 'id';
    protected $returnType     = User::class;
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'id',
        'email',
        'username',
        'password_hash',
        'token',
        'reset_hash',
        'reset_at',
        'reset_expires',
        'activate_hash',
        'status',
        'status_message',
        'active',
        'force_pass_reset',
        'permissions',
        'deleted_at',
    ];
    protected $useTimestamps   = true;

    // Aturan validasi untuk create dan update
    protected $validationRules = [
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];

    // Pesan validasi kustom
    protected $validationMessages = [
        'email' => [
            'required'   => 'Email wajib diisi.',
            'valid_email' => 'Email tidak valid.',
            'is_unique'  => 'Email sudah digunakan.',
        ],
        'username' => [
            'required'   => 'Username wajib diisi.',
            'min_length' => 'Username minimal 3 karakter.',
            'max_length' => 'Username maksimal 30 karakter.',
            'is_unique'  => 'Username sudah digunakan.',
        ],
        'password_hash' => [
            'required' => 'Password wajib diisi.',
        ],
    ];

    // protected $validationMessages = [];
    // protected $skipValidation     = false;
    // protected $afterInsert        = ['addToGroup'];

    // /**
    //  * The id of a group to assign.
    //  * Set internally by withGroup.
    //  *
    //  * @var int|null
    //  */
    protected $assignGroup;

    /**
     * Logs a password reset attempt for posterity sake.
     */
    // public function logResetAttempt(string $email, ?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    // {
    //     $this->db->table('auth_reset_attempts')->insert([
    //         'email'      => $email,
    //         'ip_address' => $ipAddress,
    //         'user_agent' => $userAgent,
    //         'token'      => $token,
    //         'created_at' => date('Y-m-d H:i:s'),
    //     ]);
    // }

    // /**
    //  * Logs an activation attempt for posterity sake.
    //  */
    // public function logActivationAttempt(?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    // {
    //     $this->db->table('auth_activation_attempts')->insert([
    //         'ip_address' => $ipAddress,
    //         'user_agent' => $userAgent,
    //         'token'      => $token,
    //         'created_at' => date('Y-m-d H:i:s'),
    //     ]);
    // }

    // /**
    //  * Sets the group to assign any users created.
    //  *
    //  * @return $this
    //  */

    // Method untuk membuat user baru
    public function createUser(array $data)
    {
        // Validasi data
        if (!$this->validate($data)) {
            return [
                'status' => false,
                'errors' => $this->errors(),
            ];
        }

        // Simpan data ke database
        try {
            $this->insert($data);
            return [
                'status' => true,
                'message' => 'User  berhasil dibuat.',
                'id' => $this->getInsertID(), // Mengembalikan ID user yang baru dibuat
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Gagal membuat user: ' . $e->getMessage(),
            ];
        }
    }

    // Method untuk memperbarui user
    public function updateUser($id, array $data)
    {
        // Validasi data
        if (!$this->validate($data)) {
            return [
                'status' => false,
                'errors' => $this->errors(),
            ];
        }

        // Update data ke database
        try {
            $this->update($id, $data);
            return [
                'status' => true,
                'message' => 'User  berhasil diperbarui.',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Gagal memperbarui user: ' . $e->getMessage(),
            ];
        }
    }

    // Fungsi untuk menghapus user dan relasi
    public function deleteUser($id)
    {
        // Cek apakah user dengan ID tersebut ada
        $user = $this->find($id);
        if (!$user) {
            return [
                'status' => false,
                'message' => 'User  tidak ditemukan.',
            ]; // User tidak ditemukan
        }

        // Hapus relasi role dari auth_groups_users
        $db = \Config\Database::connect();
        $roleBuilder = $db->table('auth_groups_users');
        $roleBuilder->where('user_id', $id);
        $roleBuilder->delete();

        // Hapus user dari tabel users
        if ($this->delete($id)) {
            return [
                'status' => true,
                'message' => 'User   berhasil dihapus.',
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Gagal menghapus user.',
            ];
        }
    }

    public function withGroup(string $groupName)
    {
        $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

        $this->assignGroup = $group->id;

        // if ($group) {
        //     $this->assignGroup = $group->id;
        // } else {
        //     // Jika grup tidak ditemukan, tambahkan kode untuk menangani situasi ini
        //     // Misalnya, throw Exception atau handle kasus yang sesuai
        //     // Di sini kita akan memaksa grup menjadi 'users' jika tidak ditemukan grup dengan nama yang diinginkan
        //     $this->assignGroup = 2; // ID grup 'users'
        // }

        return $this;
    }

    /**
     * Clears the group to assign to newly created users.
     *
     * @return $this
     */
    // public function clearGroup()
    // {
    //     $this->assignGroup = null;

    //     return $this;
    // }

    // /**
    //  * If a default role is assigned in Config\Auth, will
    //  * add this user to that group. Will do nothing
    //  * if the group cannot be found.
    //  *
    //  * @param mixed $data
    //  *
    //  * @return mixed
    //  */
    // protected function addToGroup($data)
    // {
    //     if (is_numeric($this->assignGroup)) {
    //         $groupModel = model(GroupModel::class);
    //         $groupModel->addUserToGroup($data['id'], $this->assignGroup);
    //     }

    //     return $data;
    // }

    // /**
    //  * Faked data for Fabricator.
    //  */
    // public function fake(Generator &$faker): User
    // {
    //     return new User([
    //         'email'    => $faker->email,
    //         'username' => $faker->userName,
    //         'password' => bin2hex(random_bytes(16)),
    //     ]);
    // }

    public function total()
    {
        return $this->countAll();
    }

    public function getUser()
    {
        return $this->findAll();
    }
}

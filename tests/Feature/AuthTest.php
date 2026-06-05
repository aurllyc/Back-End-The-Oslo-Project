<?php

namespace Tests\Feature;

use Database\Seeders\RoleAndPermissionSeedder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Memastikan seeder berjalan di database transaksi/refresh
        $this->seed(RoleAndPermissionSeedder::class);
    }

    // mockup credential valid
    const mhsEmail = 'mhs@example.com';
    const prodiEmail = 'prodi@example.com';
    const dospemEmail = 'dospem@example.com';
    const mitraEmail = 'mitra@example.com';
    const allPassword = 'password';

    // 2. DATA PROVIDER SEKARANG WAJIB MEMILIKI DEKLARASI TIPE DATA ': array'
    public static function roleLoginProvider(): array
    {
        return [
            'mhs' => [
                'email' => self::mhsEmail,
                'role' => 'mhs',
                'permissions' => [
                    'view dashboard', 'view notification', 'manage profile', 'manage settings',
                    'mhs:apply intership', 'mhs:view vacancies', 'mhs:fill logbook',
                    'mhs:submit final report', 'mhs:give feedback', 'mhs:view grades',
                ]
            ],
            'prodi' => [
                'email' => self::prodiEmail,
                'role' => 'prodi',
                'permissions' => [
                    'view dashboard', 'view notification', 'manage profile', 'manage settings',
                    'prodi:validate application', 'prodi:manage students', 'prodi:manage dospem',
                    'prodi:manage mitra', 'prodi:manage vacancies', 'prodi:monitor internship',
                    'prodi:assign supervisor', 'prodi:view statistics', 'prodi:export data',
                ]
            ],
            'dospem' => [
                'email' => self::dospemEmail,
                'role' => 'dospem',
                'permissions' => [
                    'view dashboard', 'view notification', 'manage profile', 'manage settings',
                    'dospem:view guided students', 'dospem:monitor logbook', 'dospem:validate and feedback',
                    'dospem:manage monitoring', 'dospem:write monitoring notes', 'dospem:submit final grade',
                    'dospem:view reports',
                ]
            ],
            'mitra' => [
                'email' => self::mitraEmail,
                'role' => 'mitra',
                'permissions' => [
                    'view dashboard', 'view notification', 'manage profile', 'manage settings',
                    'mitra:manage company profile', 'mitra:manage vacancies', 'mitra:view intership students',
                    'mitra:monitor student logbook', 'mitra:evaluate and grade', 'mitra:give student feedback',
                    'mitra:view company reports',
                ]
            ],
        ];
    }

    // 3. MENGGUNAKAN ATTRIBUTES PHP ASLI, BUKAN ANOTASI KOMENTAR Kuno
    #[Test]
    #[DataProvider('roleLoginProvider')]
    public function roles_can_login_with_valid_credentials($email, $role, $permissions): void
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => $email,
            'password' => self::allPassword,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'token',
                'user' => [
                    'id', 'name', 'email', 'roles', 'permissions',
                ],
            ])
            ->assertJsonPath('user.roles.0', $role)
            ->assertJsonPath('user.permissions', $permissions);
    }

    #[Test]
    #[DataProvider('roleLoginProvider')]
    public function roles_cannot_login_with_invalid_credentials($email, $role, $permissions): void
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => $email,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ]);
    }

    #[Test]
    #[DataProvider('roleLoginProvider')]
    public function authenticated_roles_can_logout($email, $role, $permissions): void
    {
        $loginResponse = $this->postJson('/api/v1/login', [
            'email' => $email,
            'password' => self::allPassword,
        ]);

        $token = $loginResponse->json('token');

        $logoutResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/v1/logout');

        $logoutResponse->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Logout successful',
            ]);
    }

    #[Test]
    public function unauthenticated_user_cannot_logout(): void
    {
        $response = $this->postJson('/api/v1/logout');

        $response->assertStatus(401);
    }
}

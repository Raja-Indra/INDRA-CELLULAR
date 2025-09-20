<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nama_pelanggan
 * @property string|null $nomor_hp
 * @property string|null $alamat
 * @property string|null $keterangan
 * @property string $nominal_hutang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereNamaPelanggan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereNominalHutang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereNomorHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CatatanHutang whereUpdatedAt($value)
 */
	class CatatanHutang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $provider_id
 * @property string|null $nama_produk
 * @property string|null $harga_modal
 * @property string|null $harga_jual
 * @property int $stok
 * @property string|null $jenis
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read float $keuntungan
 * @property-read \App\Models\Provider $provider
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereHargaJual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereHargaModal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereNamaProduk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereStok($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereUpdatedAt($value)
 */
	class Produk extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $nama_provider
 * @property string|null $kategori
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produk> $produks
 * @property-read int|null $produks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereNamaProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provider whereUpdatedAt($value)
 */
	class Provider extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string|null $phone
 * @property string $password
 * @property string $role
 * @property string|null $profile_photo_path
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}


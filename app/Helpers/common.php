<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
// use App\Models\Countries;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
// use App\Models\Wallet;
// use App\Models\Admin_wallets;
// use App\Models\PromotionCategory;

function encryptIt($string)
{
  if (!$string) {
    return;
  }
  $encrypt_method = 'AES-256-CBC';
  $secret_key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
  $secret_iv = 'GGEERuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
  $key = hash('sha256', $secret_key);
  $iv = substr(hash('sha256', $secret_iv), 0, 16);
  $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
  $output = base64_encode($output);
  return $output;
}

function decryptIt($string)
{
  if (!$string) {
    return;
  }
  $encrypt_method = 'AES-256-CBC';
  $secret_key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
  $secret_iv = 'GGEERuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
  $key = hash('sha256', $secret_key);
  $iv = substr(hash('sha256', $secret_iv), 0, 16);
  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  return $output;
}

function dummyuserImg()
{
  // return 'https://res.cloudinary.com/dhpmwq4ln/image/upload/v1524230998/sample_prof.png';
  return 'https://res.cloudinary.com/dxijkvz3r/image/upload/v1699431491/muisiuxprwdttxqjxsyo.png';
}

function Username($id)
{
  $query = DB::table('users')
    ->select('username')
    ->where('id', $id)
    ->first();
  return $query->username;
}

function getUserImage($id)
{
  $query = DB::table('users')
    ->select('image')
    ->where('id', $id)
    ->first();
  if ($query && $query->image) {
    return $query->image;
  } else {
    return dummyuserImg();
  }
}

function getItemImage($id, $type = '')
{
  if ($type) {
    $query = DB::table('images')
      ->select('image')
      ->where('image_id', $id)
      ->where('type', $type)
      ->get();
  } else {
    $query = DB::table('images')
      ->select('image')
      ->where('image_id', $id)
      ->get();
  }
  return $query;
}

function limit_text($text, $limit)
{
  if (str_word_count($text, 0) > $limit) {
    $words = str_word_count($text, 2);
    $pos = array_keys($words);
    $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

function checkPolls($user_id, $polls_id)
{
  $cond = ['user_id' => $user_id, 'polls_id' => $polls_id];
  $query = DB::table('votepolls')
    ->where($cond)
    ->first();
  if ($query) {
    return $query->status;
  } else {
    return false;
  }
}

function get_time_ago($time)
{
  if (!$time) {
    return false;
  }

  $time_difference = time() - $time;

  if ($time_difference < 1) {
    return 'less than 1 second ago';
  }
  $condition = [
    12 * 30 * 24 * 60 * 60 => 'year',
    30 * 24 * 60 * 60 => 'month',
    24 * 60 * 60 => 'day',
    60 * 60 => 'hour',
    60 => 'minute',
    1 => 'second',
  ];

  foreach ($condition as $secs => $str) {
    $d = $time_difference / $secs;

    if ($d >= 1) {
      $t = round($d);
      return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
    }
  }
}

function UserDetails($id)
{
  $user_details = User::where('id', $id)->get();
  return $user_details;
}
function GetEmail($id)
{
  $email = User::select('email')
    ->where('id', $id)
    ->first();
  return $email->email;
}

function GetUserName($id)
{
  if (!$id) {
    return false;
  }
  $user = User::select('username')
    ->where('id', $id)
    ->first();
  return $user ? $user->username : false;
}

// function categoty_id($id)
// {
//     $category_id = Category::select('name')->where('id', $id)->first();
//     return $category_id->name;
// }
// function country_details($id){
//     $id = 44;
//     if($id){
//         return false;
//     }

//     $country = Country::where('country_number',$id)->first();
//     return $country->country_name;
// }

function time_calculator($date)
{
  $start_date = new DateTime($date);
  $since_start = $start_date->diff(new DateTime());
  $since_start->y . ' years<br>';
  $since_start->m . ' months<br>';
  $since_start->d . ' days<br>';
  $since_start->h . ' hours<br>';
  $since_start->i . ' minutes<br>';
  $since_start->s . ' seconds<br>';

  if ($since_start->y != '0') {
    return $since_start->y . ' years ago';
  } elseif ($since_start->m != '0') {
    return $since_start->m . ' months ago';
  } elseif ($since_start->d != '0') {
    return $since_start->d . ' days ago';
  } elseif ($since_start->h != '0') {
    return $since_start->h . ' hours ago';
  } elseif ($since_start->i != '0') {
    return $since_start->i . ' minutes ago';
  } else {
    return 'Less than a minute ago';
  }
}

function flattenArray($array)
{
  $result = [];

  foreach ($array as $item) {
    if (is_array($item)) {
      $result = array_merge($result, flattenArray($item));
    } else {
      $result[] = $item;
    }
  }

  return $result;
}

function checkPollsStatus($polls_id, $opt)
{
  $cond = ['polls_id' => $polls_id, 'status' => $opt];
  $query = DB::table('votepolls')
    ->where($cond)
    ->count();
  return $query;
}

function getAllPolls($polls_id)
{
  $cond = ['polls_id' => $polls_id];
  $query = DB::table('votepolls')
    ->where($cond)
    ->count();
  return $query;
}

// function getBlance($user_id, $currency=1) {
//     $balance=0;
//     $wallet = Wallet::where('user_id', $user_id)->get();
//     if(count($wallet) == 1) {
//         $wallets = unserialize($wallet[0]['crypto_amount']);
//         $balance=$wallets[$currency];
//     }
//     return $balance;
// }

// function updateBalance($user_id, $currency=1, $balance=0) {

//     if(!$user_id && !$currency){
//         return false;
//     }

//     $wallet = Wallet::where('user_id', $user_id)->get();
//     if(count($wallet) == 1) {

//         $wallets = unserialize($wallet[0]['crypto_amount']);
//         $wallets[$currency] = $balance;
//         $upd['crypto_amount'] = serialize($wallets);
//         if($currency == 1 ){
//             $upd['splash'] = $balance;
//         }
//         Wallet::where('user_id', $user_id)->update($upd);
//     }
//     return true;
// }

// function getAdminBlance($user_id=1, $currency=1) {
//     $balance=0;
//     $wallet = Admin_wallets::where('id', $user_id)->get();
//     if(count($wallet) == 1) {
//         $wallets = unserialize($wallet[0]['crypto_amount']);
//         $balance=$wallets[$currency];
//     }
//     return $balance;
// }

// function updateAdminBalance($user_id=1, $currency=1, $balance=0) {

//     if(!$user_id && !$currency){
//         return false;
//     }

//     $wallet = Admin_wallets::where('id', $user_id)->get();
//     if(count($wallet) == 1) {
//         $wallets = unserialize($wallet[0]['crypto_amount']);
//         $wallets[$currency] = $balance;
//         $upd['crypto_amount'] = serialize($wallets);
//         Admin_wallets::where('id', $user_id)->update($upd);
//     }
//     return true;
// }

// function WalletAddress($id)
// {
//     $query = DB::table('users')->select('wallet_address')->where('id', $id)->first();
//     return $query->wallet_address;
// }

// function CurrentSplashPrice()
// {
//     $query = DB::table('tokens')->select('current_price')->where('id', 1)->first();
//     return $query->current_price;
// }

// function getProductImage($prod_id, $single=0){
//     if(!$prod_id){
//         return false;
//     }

//     if($single){
//         $query = DB::table('product_images')->where('product_id', $prod_id)->first();
//         return $query->image;
//     }

//     return DB::table('product_images')->where('product_id', $prod_id)->get();
// }

// function getProduct($prod_id){
//     if(!$prod_id){
//         return false;
//     }
//     $query = DB::table('stores')->where('id', $prod_id)->first();
//     return $query;
// }

// function promotionCategotyId($id)
// {
//     $sql = PromotionCategory::select('name')->where('id', $id)->first();
//     return $sql->name;
// }

function get_client_ip()
{
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP')) {
    $ipaddress = getenv('HTTP_CLIENT_IP');
  } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  } elseif (getenv('HTTP_X_FORWARDED')) {
    $ipaddress = getenv('HTTP_X_FORWARDED');
  } elseif (getenv('HTTP_FORWARDED_FOR')) {
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
  } elseif (getenv('HTTP_FORWARDED')) {
    $ipaddress = getenv('HTTP_FORWARDED');
  } elseif (getenv('REMOTE_ADDR')) {
    $ipaddress = getenv('REMOTE_ADDR');
  } else {
    $ipaddress = 'UNKNOWN';
  }
  return $ipaddress;
}

if (!function_exists('underscoreToSpace')) {
  /**
   * Convert underscores to spaces and remove extra spaces.
   *
   * @param string $input
   * @return string
   */
  function underscoreToSpace($input)
  {
    // dd($input);
    if (!$input) {
      return;
    }

    // Convert underscores to spaces
    $output = str_replace('_', ' ', $input);

    // Remove extra spaces
    $output = preg_replace('/\s+/', ' ', $output);

    return ucfirst(trim($output));
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Member;
use App\Bill;
use App\Listpurchased;
use App\Brands;
use App\Classify;
use App\Category;
use App\Collections;
use App\Hardware;
use App\Specifications;

class C_controller extends Controller
{
	//Home
	public function list_products() {
		$data = Products::join('class', 'products.nhomsp', '=', 'class.nhomsp')->select('products.*', 'class.*')->where('products.tthai', '<>', 0)->orderBy('class.maphanloai')->orderBy('products.giasp')->get();
		
		return view('list-products', compact('data'));
	}

	//Đăng kí
	public function register() {
		if (session()->has('signin')){
			return view('profile');
		}
		else{
			return view('register');
		}
	}
	public function post_register(Request $rq) {
		$ho = $rq->input('ltname');
		$ten = $rq->input('ftname');
		$gioitinh = $rq->input('sex');
		$email = $rq->input('email');
		$pw1 = md5($rq->input('password'));
		$sdt = $rq->input('phonenumber');
		$diachi = $rq->input('address');

		Member::insert([
			'ho' => $ho, 'ten' => $ten, 'email' => $email, 'matkhau' => $pw1, 'gioitinh' => $gioitinh, 'sdt' => $sdt, 'diachi' => $diachi
		]);

		return redirect('/signin');
	}

	//Đăng nhập
	public function signin($checkout = null) {
		if (session()->has('signin')){
			session()->forget('signin');
			session()->forget('cart');

			return redirect('signin');
		}
		else{
			return view('signin', compact('checkout'));
		}
	}
	public function post_signin(Request $rq) {
		$checkout = $rq->input('checkout');
		$email = $rq->input('email');
		$matkhau = md5 ($rq->input('password'));

		$sql = Member::where('email', $email)->where('matkhau', $matkhau)->first();

		if ($sql != null){
			session(['signin' => $email]);

			if ($checkout == null) {
				return redirect('home');
			}
			else {
				return redirect('checkout');
				//return redirect()->back();
			}
		}

		else{
			echo "sai rồi";
		}
	}

	//Giỏ hàng
	public function addtocart($id) {
		if (session("cart.$id")) {
			session(["cart.$id" => session("cart.$id") + 1]);
		}
		else{
			session(["cart.$id" => 1]);
		}

		return redirect('/cart');
	}
	public function delitem($id) {
		session()->forget("cart.$id");

		return redirect('cart');
	}
	public function cart() {
		if (session()->has('cart') == TRUE && count(session('cart')) > 0) {
			foreach (array_keys (session ('cart')) as $key) {
				$arr[] = $key;
			}

			$data = Products::whereIn('masp', $arr)->get();
		}
		else{
			$data = NULL;
		}

		return view('cart', compact('data'));
	}

	//Thanh toán
	public function checkout() {
		if (session()->has('signin')){
			$email = session()->get('signin');
			$info = Member::where('email', $email)->first();

			foreach (array_keys (session ('cart')) as $key) {
				$arr[] = $key;
			}

			$cart = Products::whereIn('masp', $arr)->get();

			return view('checkout', compact('info'), compact('cart'));
		}
		else{
			return redirect('signin\checkout');
		}
	}
	public function buy() {
		$email = session()->get('signin');
		$info = Member::where('email', $email)->first();
		$bill = Bill::insert([
			'hoten' => $info->ho." ".$info->ten, 'diachi' => $info->diachi, 'sdt' => $info->sdt, 'taikhoan' => $email, 'trangthai' => 1
		]);

		if ($bill == TRUE) {
			$mahoadon = Bill::where('taikhoan', $email)->orderBy('mahoadon', 'desc')->first();

			foreach (array_keys (session('cart')) as $key) {
				$arr[] = $key;
			}

			$cart = Products::whereIn('masp', $arr)->get();

			foreach ($cart as $item) {
				$execute = Listpurchased::insert([
					'mahoadon' => $mahoadon->mahoadon, 'masp' => $item->masp, 'soluong' => session()->get("cart.$item->masp"), 'giasp' => $item->giasp
				]);
			}

			if ($execute == TRUE) {
				session()->forget('cart');
				return redirect('order');
			}
			else {
				return redirect('checkout');
			}
		}
	}

	//Danh sách đơn.
	public function order() {
		$email = session()->get('signin');

		$bill = Bill::where('taikhoan', $email)->get();

		return view('order', compact('bill'));
	}

	//Sản phẩm
	public function product($id)
	{
		$product = Products::where('products.masp', $id)->first();
		$specifications = Specifications::join('hardware', 'specifications.maphancung', '=', 'hardware.maphancung')->where('specifications.masp', $id)->get();
		$hinhanh = explode(', ', $product->hinhanh);
		
		return view('product', compact('product', 'specifications', 'hinhanh'));
	}

	//Bộ lọc
	public function collections($classify, $keyword = null) {
		//Tao bien
		$price = null;
		$brand = null;
		if (substr( $keyword, 0, 1) == '-') {
			$brand = substr( $keyword, 1, strlen($keyword) - 1);
		}
		else {			
			$last = strpos( $keyword, 'trieu');

			$price = substr( $keyword, 0, $last + 5);
			$brand = substr( $keyword, $last + 6, strlen($keyword) - $last);
		}

		//data
		if ($keyword == null) {
			$data = Products::join('class', 'products.nhomsp', '=', 'class.nhomsp')->join('category', 'class.maphanloai', '=', 'category.maphanloai')->select('products.*', 'category.tenphanloai')->where('category.tenphanloai', '=', $classify)->get();
		}
		else {
			$limit = Collections::where('keyword', '=', $price)->first();

			if ($brand == null && $price != null) {
				$data = products::join('class', 'products.nhomsp', '=', 'class.nhomsp')->join('category', 'class.maphanloai', '=', 'category.maphanloai')->select('products.*', 'category.tenphanloai')->where('category.tenphanloai', '=', $classify)->where('products.giasp', '>=', $limit->min)->where('products.giasp', '<=', $limit->max)->get();
			}
			else if ($brand != null && $price != null) {
				$collect = Brands::join('category', 'brands.maphanloai', '=', 'category.maphanloai')->where('category.tenphanloai', '=', $classify)->where('brands.tenhang', 'like', $brand)->select('brands.mahang')->first();

				$data = Products::join('class', 'products.nhomsp', '=', 'class.nhomsp')->join('category', 'class.maphanloai', '=', 'category.maphanloai')->select('products.*', 'category.tenphanloai')->where('category.tenphanloai', '=', $classify)->where('products.mahang', '=', $collect->mahang)->where('products.giasp', '>=', $limit->min)->where('products.giasp', '<=', $limit->max)->get();
			}
			else if ($brand != null && $price == null){
				$collect = Brands::join('category', 'brands.maphanloai', '=', 'category.maphanloai')->where('category.tenphanloai', '=', $classify)->where('brands.tenhang', 'like', $brand)->select('brands.mahang')->first();

				$data = Products::join('class', 'products.nhomsp', '=', 'class.nhomsp')->join('category', 'class.maphanloai', '=', 'category.maphanloai')->select('products.*', 'category.tenphanloai')->where('category.tenphanloai', '=', $classify)->where('products.mahang', '=', $collect->mahang)->get();
			}
			else {

			}
		}

		//offer
		if (count($data) != 0) {
			foreach ($data as $value) {
				$arr[] = $value->masp;
			}
			$offer = Brands::join('products', 'brands.mahang', '=', 'products.mahang')->join('category', 'brands.maphanloai', '=', 'category.maphanloai')->select('brands.tenhang', 'category.tenphanloai',)->where('category.tenphanloai', '=', $classify)->whereIn('products.masp', $arr)->groupBy('tenhang', 'tenphanloai')->orderBy('brands.mahang')->get();

			if ($offer->count() == 1) {
				$offer = null;	
			}
		}
		else {
			$offer = null;
		}

		return view('collections', compact('classify', 'price', 'data', 'offer'));
	}

	public function test($classify, $keyword = null) {
		if (substr( $keyword, 0, 1) == '-') {
			$brand = substr( $keyword, 1, strlen($keyword) - 1);
			
			echo $brand;
		}
		else {
			$last = strpos( $keyword, 'trieu');
			
			$price = substr( $keyword, 0, $last + 5);
			$brand = substr( $keyword, $last + 6, strlen($keyword) - $last);
		
			echo $last."<br>".$price."<br>".$brand;
		}
	}

}

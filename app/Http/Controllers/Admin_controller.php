<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Brands;
use App\Admin;
use App\Member;
use App\Bill;
use App\Listpurchased;
use App\Specifications;
use App\Classify;
use App\Category;
use App\Collections;
use App\Grouphw;
use App\Hardware;
use App\Parameter;

class Admin_controller extends Controller
{
	function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        		
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
		return $str;
    }
	
	//Trang chủ
	public function index() {
		if (session()->has('admin')) {
			return view('admin/index');
		}
		else {
			return redirect('admin');
		}
	}

	//Đăng nhập
	public function signin() {
		if (session()->has('admin')) {
			session()->forget('admin');

			return redirect('admin/signin');
		}
		else {
			return view('Admin/signin');
		}
	}
	public function post_signin(Request $rq) {
		$taikhoan = $rq->input('account');
		$matkhau = md5($rq->input('password'));

		$execute = Admin::where('taikhoan', $taikhoan)->where('matkhau', $matkhau)->first();

		if ($execute == TRUE && $execute->trangthai == 1) {
			session(['admin' => $taikhoan]);

			return redirect('admin\sanpham');
		}
		else {
			echo "Không đăng nhập được";
		}
	}

	//Sản phẩm
	public function products() {
		$items = Products::all();
		$brands = Brands::all();
		$class = Classify::orderby('maphanloai')->get();
		$tensp = Products::where('masp', '<>', 'SELECT masp FROM specifications')->get();
 
		$products = Products::join('brands', 'products.mahang', '=', 'brands.mahang')->join('class', 'products.nhomsp', '=', 'class.nhomsp')->select('products.*', 'brands.*', 'class.*')->orderby('products.masp')->get();

		return view('Admin/products', compact('products', 'brands', 'class','items'));
	}

	public function insert_item(Request $rq) {
		$tensp = $rq->input('tensp');
		$hsx = $rq->input('hangsx');
		$giasp = $rq->input('giasp');
		$nhomsp = $rq->input('nhomsp');
		$trangthai = $rq->input('trangthai');

		if ($rq->hasFile('image')) {
			$file = $rq->file('image');
			
			$tenhinh = $file->getClientOriginalName();

			if (file_exists('public/products-picture/'.$tenhinh) == false) {
				$file->move('public/products-picture', $tenhinh);
			}
			else {
				
				//unlink('public/products-picture/'.$tenhinh);
			}
		}
		else {
			$tenhinh = "Chưa bổ xung";
		}

		$checkout = Products::where('tensp', $tensp)->first();

		if ($checkout == TRUE) {
			$error = "<script>alert ('Sản phẩm đã tồn tại')</script>";
			
			return redirect()->back();
		}
		else {
			$execute = Products::insert([
			'tensp' => $tensp, 'mahang' => $hsx, 'giasp' => $giasp, 'nhomsp' => $nhomsp, 'hinhanh' => $tenhinh, 'tthai' => $trangthai
			]);

			if ($execute == TRUE) {
				return redirect()->back();
			}
			else {
				echo "Không thêm được";
			}
		}
	}

	public function del_item($id) {
		$checkout = Specifications::where('masp', $id)->first();

		if ($checkout == TRUE) {
			$update = Products::where('masp', $id)->update(['tthai' => 0]);
		}
		else {
			$del = Products::where('masp', $id)->delete();
		}

		return redirect()->back();
	}

	public function edit_item($id) {
		$brands = Brands::all();
		$class = Classify::join('category', 'class.maphanloai', '=', 'category.maphanloai')->get();

		$item = Products::join('class', 'products.nhomsp', '=', 'class.nhomsp')->join('category', 'class.maphanloai', '=', 'category.maphanloai')->join('brands', 'products.mahang', '=', 'brands.mahang')->where('products.masp', $id)->first();
		$photos = explode(", ", $item->hinhanh);

		/*
			//Cần tìm outer join của laravel
			$thongso = Specifications::where('specifications.masp', $id)->pluck('thongso', 'maphancung');

			$hardware = Hardware::join('group-hardware', 'hardware.manhom', '=', 'group-hardware.manhom')->where('group-hardware.maphanloai', '=', $item->maphanloai)->get();
		*/	

		$dau = Specifications::join('hardware', 'specifications.maphancung', '=', 'hardware.maphancung')->where('specifications.masp', $id)->get();
		$maphancung = Specifications::where('masp', $id)->pluck('maphancung');
		$cuoi = Hardware::whereNotIn('maphancung', $maphancung)->get();

		return View('Admin/edit-item', compact('brands', 'class', 'item', 'photos', 'dau','cuoi'));
	}

	public function update_item($id, Request $rq) {
		$class = Products::where('masp', $id)->join('class', 'products.nhomsp', '=', 'class.nhomsp')->select('class.maphanloai')->first();
		$maphancung = Hardware::join('group-hardware', 'hardware.manhom', '=', 'group-hardware.manhom')->where('group-hardware.maphanloai', $class->maphanloai)->get();
		foreach ($maphancung as $key => $value) {
			$input = $rq->input($value->maphancung);

			$checkout = Specifications::where('masp', $id)->where('maphancung', $value->maphancung)->first();

			if ($checkout == TRUE) {
				if ($checkout->thongso == null || $checkout->thongso != $input) {
					$update = Specifications::where('maphancung', $value->maphancung)->update(['thongso' => $input]);
				}
				else {
					break;
				}
			}
			else {
				$insert = Specifications::insert([
					'masp' => $id, 'maphancung' => $value->maphancung, 'thongso' => $input
				]);
			}
		}

		return redirect()->back();
	}

	//Hãng sản xuất
	public function brands() {
		$brands = Brands::join('category', 'Brands.maphanloai', '=', 'category.maphanloai')->select('brands.*', 'category.*')->orderby('brands.mahang')->orderby('brands.maphanloai')->get();
		$category = Category::all();

		return view('Admin/brands', compact('brands', 'category'));
	}

	public function del_brand($id) {
		$execute = Brands::join('products', 'brands.mahang', '=', 'products.mahang')->select('brands.mahang')->where('brands.mahang', $id)->first();

		if ($execute == TRUE) {
			$error = "<script>alert('Xóa hãng này sẽ ảnh hưởng đến bảng khác'); location='{{url ("."/admin/hangsx".")}}';</script>";

			echo $error;

			return redirect()->back();
		}
		else {
			$execute = Brands::where('mahang', $id)->delete();

			return redirect()->back();
		}
	}

	public function insert_brand(Request $rq) {
		$loaisp = $rq->input('loaisp');
		$tenhang = ucwords(strtolower($rq->input('tenhang')));
		$tthai = $rq->input('tthai');


		$execute = Brands::insert([
			'maphanloai' => $loaisp, 'tenhang' => $tenhang, 'status' => $tthai
		]);

		if ($execute == TRUE) {
			return redirect()->back();
		}
		else {
			echo "Chưa thêm được dữ liệu";
		}
	}

	//Cấu hình
	public function option() {
		$specifications = Specifications::join('products', 'products.masp', '=', 'specifications.masp')->select('specifications.*', 'products.tensp')->get();

		$accessories = Accessories::all();
		
		if (count($specifications) == 0) {
			$products = Products::select('masp', 'tensp')->get();	
		}
		else {
			foreach ($specifications as $key => $value) {
				$arr[] = $value->masp;
			}

			$products = Products::select('masp', 'tensp')->whereNotIn('masp', $arr)->get();	
		}

		return view('Admin/option', compact('specifications', 'accessories', 'products'));
	}
	public function del_option($id) {
		$execute = Specifications::where('masp', $id)->delete();

		if ($execute == false) {
			
			return redirect()->back();
		}
		else {
			$error = "<script>alert('Chưa xóa được');</script>";

			return redirect()->back();
		}
	}
	public function insert_option(Request $rq) {
		$masp = Products::where('tensp', $rq->input('tensp'))->select('masp')->first();
	}

	//Linh kiện
	public function accessories() {
		$phanloai = Category::all();
		$nhomphancung = Grouphw::all();

		$accessories = Specifications::join('hardware', 'specifications.maphancung', '=', 'hardware.maphancung')->join('group-hardware', 'hardware.manhom', '=', 'group-hardware.manhom')->join('category', 'group-hardware.maphanloai', '=', 'category.maphanloai')->get();

		foreach ($accessories as $key => $value) {
			echo $value."<br>";
		}
		
		return view('Admin/accessories', compact('accessories', 'phanloai', 'nhomphancung'));
	}

	//Collections
	public function collections() {
		$collections = Collections::orderBy('max')->get();
		$category = Category::all();

		return view('Admin/collections', compact('collections', 'category'));
	}
	public function insert_collection(Request $rq) {
		$phanloai = $rq->input('phanloai');	
		$mucgia = $rq->input('mucgia');
		$min = $rq->input('min');
		$max = $rq->input('max');

		$keyword = $this->vn_str_filter(str_replace(' ', '-', $mucgia));
		
		$execute = Collections::insert([
			'tenphanloai' => $phanloai, 'mucgia' => $mucgia, 'keyword' => $keyword, 'min' => $min, 'max' => $max
		]);

		return redirect()->back();
	}
}
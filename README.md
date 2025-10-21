# Dự án Xây dựng Web Xem Phim trực tuyến 🎬

# Thành viên 
- **Nguyễn Thị Lan Anh :** 23010823
- **Đào Phúc Vinh :** 23010702 

- **Lớp:** Kĩ thuật phần mềm 1-1-25(COUR01.TH5)
  ***

# Mô Tả Dự Án
📖 Giới thiệu

Dự án Web Xem Phim là một ứng dụng web được xây dựng nhằm cung cấp cho người dùng nền tảng xem phim trực tuyến.
Người dùng có thể tìm kiếm, xem thông tin phim, trailer, và xem phim trực tiếp trên website.
Quản trị viên có thể quản lý danh sách phim, thể loại, tài khoản người dùng và các nội dung liên quan.

## Công nghệ sử dụng
Ngôn ngữ lập trình: PHP 

Framework: Laravel
Ngôn ngữ giao diện (Frontend):HTML, CSS, JavaScript,Blade

Cơ sở dữ liệu:MySQL (thông qua thư mục database và file .env để cấu hình kết nối).

Công cụ phát triển: Visual Studio Code, XAMPP

Lưu trữ: GitHub

## Chức năng chính
🎬 1. Trang chủ (Home Page)

Hiển thị danh sách các phim nổi bật, mới cập nhật hoặc được xem nhiều.

Có thanh tìm kiếm và bộ lọc theo thể loại, năm phát hành, quốc gia.


📂 2. Trang danh mục phim (Category Page)

Hiển thị phim theo thể loại (hành động, tình cảm, kinh dị,…).

Cho phép sắp xếp theo tên, ngày đăng, lượt xem.


🔍 3. Tìm kiếm phim (Search)

Người dùng có thể nhập tên phim để tìm nhanh.

Kết quả hiển thị danh sách phim khớp với từ khóa.


🎥 4. Trang xem phim (Watch Page)

Phát video phim (thường là embed hoặc file lưu trên server/CDN).

Hiển thị thông tin chi tiết: tên phim, mô tả, diễn viên, năm phát hành.


👤 5. Đăng nhập / Đăng ký (Authentication)

Cho phép người dùng đăng nhập, đăng ký tài khoản.

Có thể lưu lịch sử xem phim, yêu thích phim.


⭐ 6. Quản trị viên (Admin Panel)

Quản lý danh sách phim: thêm, sửa, xóa.

Quản lý thể loại, diễn viên, năm phát hành, ảnh thumbnail, trailer.

Quản lý người dùng (nếu có tính năng thành viên).


💾 7. Lưu dữ liệu (Database Integration)

Toàn bộ thông tin phim, tài khoản người dùng, thể loại được lưu trong cơ sở dữ liệu (MySQL hoặc SQLite).

Các model trong Laravel như Movie, Category, User, v.v. quản lý dữ liệu này.


🌐 8. Giao diện người dùng (Frontend)

Sử dụng HTML, CSS, JS (và có thể Blade template trong Laravel).

Giao diện thân thiện, responsive để xem trên điện thoại và máy tính.

Có gợi ý phim liên quan hoặc phim cùng thể loại.


# Sơ đồ hệ thống Website
## Sơ đồ chức năng

<img width="471" height="902" alt="image" src="https://github.com/user-attachments/assets/162d95cb-e13b-4843-ba1f-9ff10e1a7f4e" />

## Sơ đồ thuật toán
Đăng nhập

<img width="351" height="304" alt="image" src="https://github.com/user-attachments/assets/95ea7ce7-2f4c-4634-b6d1-6ef1faaca7c4" />

Đăng kí 

<img width="388" height="329" alt="image" src="https://github.com/user-attachments/assets/8b3f3b5a-6624-4107-9e7d-25f60671a855" />

Xem danh sách phim

<img width="420" height="297" alt="image" src="https://github.com/user-attachments/assets/328a5c80-fd16-45ff-b373-027108655723" />

## Cài đặt
```bash
git clone 'url'
composer install
cp .env.example .env
php artisan key:generate
# Cập nhật thông tin DB trong .env
php artisan migrate --seed
Tài khoản mẫu
//admin
Email: admin@gmail.com
Pass: 123456
//user
Email: user@gmail.com
Pass: 123456
```

# Code minh hoạ Project
## Model
User Model
```bash
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
```

# Controller
IndexController 
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use DB;

class IndexController extends Controller
{
    public function timkiem()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $category = Category::orderBy('position','ASC')->where('status',1)->get();
            $genre = Genre::orderBy('id','DESC')->get();
            $country = Country::orderBy('id','DESC')->get();
            $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
            $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();

           

            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);

            return view('pages.timkiem', compact('category','genre','country','search','movie','phimhot_sidebar','phimhot_trailer'));

        }else{
            return redirect()->to('/');
        }
        
        

    }
    public function home(){
        $phimhot = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $category_home = Category::with('movie')->orderBy('position','ASC')->where('status',1)->get();
    	return view('pages.home', compact('category','genre','country','category_home','phimhot','phimhot_sidebar','phimhot_trailer'));
    }
    public function category($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.category', compact('category','genre','country','cate_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function year($year){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $year = $year;
        $movie = Movie::where('year',$year)->orderBy('ngaycapnhat','DESC')->paginate(40);
        return view('pages.year', compact('category','genre','country','year','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function tag($tag){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $tag = $tag;
        $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);
        return view('pages.tag', compact('category','genre','country','tag','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function genre($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $genre_slug = Genre::where('slug',$slug)->first();
        //nhiu the loai
        $movie_genre = Movie_Genre::where('genre_id',$genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi){
            $many_genre[] = $movi->movie_id;
        }
        
        $movie = Movie::whereIn('id',$many_genre)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.genre', compact('category','genre','country','genre_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function country($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $country_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$country_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.country', compact('category','genre','country','country_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function movie($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();

        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();

        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->where('status',1)->first();
        $episode_tapdau = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();

        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        //lay 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','DESC')->take(3)->get();
        // lấy tổng tập phim đã thêm
        $episode_current_list = Episode::with('movie')->where('movie_id',$movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();


    	return view('pages.movie', compact('category','genre','country','movie','related','phimhot_sidebar','phimhot_trailer','episode','episode_tapdau','episode_current_list_count'));
    }
    public function watch($slug,$tap){

       
        
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();

        $movie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->where('status',1)->first();

        if(isset($tap)){
            $tapphim = $tap;
            $tapphim = substr($tap, 4,1);
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        }else{
            $tapphim = 1;
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        }

        // return response()->json($movie);
    	return view('pages.watch', compact('category','genre','country','movie','phimhot_sidebar','phimhot_trailer','episode','tapphim'));
    }
    public function episode(){
    	return view('pages.episode');
    }
}

```
# Một Số Hình Ảnh Chức Năng Chính
1. Đăng nhập

   <img width="1127" height="428" alt="image" src="https://github.com/user-attachments/assets/e18cd28b-3884-4a3a-8698-660d2c8d3a48" />

   ***Người dùng truy cập vào trang đăng nhập sẽ thấy giao diện gồm các thành phần chính***

        Trường “E-Mail Address”: nơi người dùng nhập địa chỉ email đã đăng ký tài khoản.

        Trường “Password”: nơi nhập mật khẩu tương ứng với tài khoản.

        Tùy chọn “Remember Me”: giúp lưu phiên đăng nhập cho lần truy cập sau.

        Nút “Login”: gửi thông tin lên server để xác thực người dùng.

        Liên kết “Forgot Your Password?”: hỗ trợ người dùng đặt lại mật khẩu khi quên.
   Nếu thông tin hợp lệ, người dùng sẽ được chuyển hướng đến trang quản trị hoặc trang chủ của website. Nếu sai, hệ thống sẽ hiển thị thông báo lỗi tương ứng.

2.Đăng kí 

   <img width="1199" height="598" alt="image" src="https://github.com/user-attachments/assets/d024f3b3-0a21-4f2e-afe7-8ac98c10c10a" />
   ***Giao diện gồm các thành phần chính***

        Name: người dùng nhập tên hiển thị của mình.

        E-Mail Address: địa chỉ email dùng để đăng ký và nhận thông báo từ hệ thống.

        Password: mật khẩu dùng để đăng nhập.

       Confirm Password: nhập lại mật khẩu để xác nhận, tránh sai sót.

       Nút “Register”: khi nhấn, hệ thống sẽ kiểm tra tính hợp lệ của thông tin nhập vào.

       Nếu người dùng nhập đúng định dạng và email chưa được sử dụng, tài khoản sẽ được tạo và lưu vào cơ sở dữ liệu. Sau đó, hệ thống có thể tự động chuyển hướng đến trang đăng nhập hoặc trang chủ.
Trong trường hợp nhập sai hoặc trùng email, Laravel sẽ hiển thị thông báo lỗi cụ thể để người dùng sửa lại thông tin.

→ Chức năng đăng ký giúp đảm bảo mỗi người dùng có tài khoản riêng biệt, phục vụ cho quá trình quản lý và bảo mật hệ thống.

3.Trang Admin 

  <img width="1890" height="918" alt="image" src="https://github.com/user-attachments/assets/1a6b4c61-7cd3-40ba-9840-45d8308dcbad" />

  ***Giao diện trang được thiết kế trực quan, gồm các thành phần chính***

     Thanh menu điều hướng (Navigation Bar) ở phía trên cho phép admin truy cập nhanh đến các danh mục:

         Trang chủ, Thể loại, Quốc gia, Năm phim, Phim chiếu rạp, Phim lẻ, Phim mới, Phim thuyết minh, Phim hoạt hình, Phim bộ.

     Thanh tìm kiếm (Search bar) giúp tìm nhanh phim theo tên.

     Khu vực lọc phim (Lọc phim) cho phép lọc theo thể loại hoặc trạng thái (phim mới, phim hot, phim chiếu rạp…).

     Danh sách phim hiển thị (Phim hot, Phim chiếu rạp, Phim mới...) được sắp xếp theo từng mục riêng. Mỗi phim có ảnh đại diện, tiêu đề, định dạng (HD, Trailer, HDCam, Phụ đề...), cùng thông tin lượt xem.

    Tại đây, admin có thể thực hiện các chức năng như:

          Thêm mới phim, chỉnh sửa thông tin, xóa phim cũ.

          Cập nhật thể loại, quốc gia, năm sản xuất.

         Theo dõi lượng xem và tình trạng phim để điều chỉnh nội dung phù hợp.

→ Trang Admin là thành phần quan trọng trong hệ thống, giúp quản lý toàn bộ dữ liệu phim, đảm bảo website luôn hiển thị thông tin chính xác và cập nhật.

4. Chi tiết phim

   <img width="1364" height="910" alt="image" src="https://github.com/user-attachments/assets/b2a75a13-7c71-4975-8e95-080ea4662214" />

5.Trang quản lý phim


   <img width="988" height="902" alt="image" src="https://github.com/user-attachments/assets/0b2d8d87-f06f-4367-9a3f-3aa088fe3d2b" />

   <img width="967" height="928" alt="image" src="https://github.com/user-attachments/assets/84f3be57-5f68-411b-9b35-e17d1f37dfbd" />

6. Giao diện quản lý danh sách phim

   <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/47a13b08-0329-4ca2-9eeb-5ebd11752f22" />
   

🧩 Chức năng chính của Trang quản lý phim và giao diện quản lý danh sách phim

Cho phép quản trị viên nhập thông tin phim mới vào hệ thống.

Các trường nhập bao gồm:

Tên phim

Số tập phim

Thời lượng

Tên tiếng Anh

Trailer

Đường dẫn

Mô tả phim

Tags phim
...

Có nút để lưu phim vào cơ sở dữ liệu , quay lại trang danh sách phim và có thể sửa xóa ở phần danh sách phim nếu quản trị viên muốn.


   



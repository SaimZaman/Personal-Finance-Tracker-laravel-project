namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if user is admin
        if (Auth::user()->usertype === 'admin') {
            return view('admin.dashboard');
        }

        // Default: normal user
        return view('login');
    }
}

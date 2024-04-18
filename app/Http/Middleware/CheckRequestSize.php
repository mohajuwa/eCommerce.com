<?

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\CheckRequestSize as Middleware;

class CheckRequestSize extends Middleware
{
    public function handle($request, Closure $next)
    {
        if ($request->server('CONTENT_LENGTH') > (int) ini_get('post_max_size')) {
            return back()->with('error', 'The uploaded file exceeds the maximum file size allowed.');
        }

        return $next($request);
    }
}

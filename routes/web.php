<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Model\Table\Photos;

# events_id แบบฟิกไปก่อน
const events_id = 1;
const users_id = 92642;
const dept_id = '10101021';

Route::get('/', function () {
    return view('body');
});

Route::get('/clusters', function () {
    return view('clusters.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/admins', function () {
    session()->put('events_id', '1');

    return view('admins.upload');
    // $users = DB::table('events')->where('id', 1)->update(['name' => 'testttt']);

    // return response()->json($users);
});

Route::post('/admins/uploading', function (Request $request) {
    $x = rand(1,3);
    sleep($x);

    $events_id = session()->get('events_id', null);

    # ==>
    try {
        if ($events_id == null) {
            throw new \PDOException('No events selected');
        }
        else if (@$request->hasFile('files')) {
            
            # destination
            # ที่วางไฟล์
            $destination = public_path('photo');

            # files
            # อินพุทจาก client
            $files = $request->file('files');

            DB::beginTransaction();
            
                # ทำ transcation ดาต้าเบด
                $photos_id = 
                    Photos::updateOrCreate(
                        [
                            'id' => $request->input('id'), 
                            'events_id' => $events_id, 
                            'filename' => $files->getClientOriginalName()
                        ], 
                        [
                            'name' => 'alt of naming', 
                        ]
                    );

                # ทำ transcation แบบไฟล์หลังบ้าน
                $files->move($destination, $files->getClientOriginalName());

            DB::commit();

            return response()->json([
                'id' => $photos_id, 
                'message' => 'Successful updated', 
            ]);
        }
        else {
            throw new Exception('No files detection');
        }
    } catch (\PDOException $e) {
        DB::rollBack();

        return response()->json([
            'error' => true, 
            'message' => $e->getMessage()
        ]); 
    }

    // $res = new \stdClass();
    // $res->name = @$request->input('name')?:'undefined';
    // $res->n = $x;

    // return response()->json($res);
});

<?php

namespace App\Http\Controllers\Api;

use App\Enum\ProvinceEnum;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;



class SchoolController extends Controller
{


    /**
 * @OA\Get(
 *      path="/schools",
 *      operationId="index",
 *      tags={"Schools"},
 *      summary="Get list of schools",
 *      description="Returns list of schools",
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string"),
 *              @OA\Property(property="message", type="string"),
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer"),
 *                      @OA\Property(property="name", type="string"),
 *                      @OA\Property(property="email", type="string"),
 *                      @OA\Property(property="numberOfRooms", type="integer"),
 *                      @OA\Property(property="province", type="string"),
 *                      @OA\Property(property="created_at", type="string", format="date-time"),
 *                      @OA\Property(property="updated_at", type="string", format="date-time"),
 *                  ),
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer"),
 *                      @OA\Property(property="name", type="string"),
 *                      @OA\Property(property="email", type="string"),
 *                      @OA\Property(property="numberOfRooms", type="integer"),
 *                      @OA\Property(property="province", type="string"),
 *                      @OA\Property(property="created_at", type="string", format="date-time"),
 *                      @OA\Property(property="updated_at", type="string", format="date-time"),
 *                  )
 *              )
 *          )
 *      )
 * )
 */

    public function index()
    {
        $schools = School::all();
            return response()->json(['status'=>'Success','message'=>'Success','data'=>$schools],Response::HTTP_OK);

    }


        /**
 * @OA\Post(
 *      path="/school",
 *      operationId="store",
 *      tags={"Schools"},
 *      summary="Create a new school",
 *      description="Creates a new school with the provided details",
 *      @OA\Parameter(
 *          name="name",
 *          in="query",
 *          required=true,
 *          description="Name of the school",
 *          @OA\Schema(type="string")
 *      ),
 *      @OA\Parameter(
 *          name="email",
 *          in="query",
 *          required=true,
 *          description="Email of the school",
 *          @OA\Schema(type="string", format="email")
 *      ),
 *      @OA\Parameter(
 *          name="numberOfRooms",
 *          in="query",
 *          required=true,
 *          description="Number of rooms in the school",
 *          @OA\Schema(type="integer", minimum=1)
 *      ),
 *     @OA\Parameter(
 *          name="province",
 *          in="query",
 *          required=true,
 *          description="Province where the school is located",
 *           @OA\Schema(type="string", enum=ProvinceEnum::PROVINCES)
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Created",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="Success"),
 *              @OA\Property(property="message", type="string", example="School registered successfully!")
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="Error"),
 *              @OA\Property(property="message", type="string", example="Invalid input data")
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="Error"),
 *              @OA\Property(property="message", type="string", example="Internal Server Error")
 *          )
 *      )
 * )
 */


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'numberOfRooms' => 'required|integer|min:1',
            'province' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'Error', 'message' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }


        $saved = School::create($request->all());
        if($saved){
            return response()->json(['status'=>'Success','message'=>'School registered successfully!'], Response::HTTP_CREATED);
        }
            return response()->json(['status'=>'Error','message'=>'error occurred while registering!'], Response::HTTP_INTERNAL_SERVER_ERROR);

    }

   /**
 * @OA\Get(
 *      path="/schools/{id}",
 *      operationId="show",
 *      tags={"Schools"},
 *      summary="Get a specific school by ID",
 *      description="Returns details of a school based on ID",
 *      @OA\Parameter(
 *          name="id",
 *          description="School ID",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="Success"),
 *              @OA\Property(property="message", type="string", example="Success"),
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="email", type="string"),
 *                  @OA\Property(property="numberOfRooms", type="integer"),
 *                  @OA\Property(property="province", type="string"),
 *                  @OA\Property(property="created_at", type="string", format="date-time"),
 *                  @OA\Property(property="updated_at", type="string", format="date-time"),
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="School not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="Error"),
 *              @OA\Property(property="message", type="string", example="School not found")
 *          )
 *      )
 * )
 */

    public function show(int $id)
    {
        $school = School::find($id);
        if($school)
          return response()->json(['status'=>'Success','message'=>'Success','data'=>$school],Response::HTTP_OK);

          return response()->json(['status'=>'Error','message'=>'School not found'],Response::HTTP_NOT_FOUND);

    }

        /**
     * Update the specified school.
     *
     * @OA\Put(
     *      path="/school/{id}",
     *      operationId="update",
     *      tags={"Schools"},
     *      summary="Update an existing school",
     *      description="Updates an existing school with the provided details",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the school to be updated",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Name of the school",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="Email of the school",
     *          required=false,
     *          @OA\Schema(type="string", format="email")
     *      ),
     *      @OA\Parameter(
     *          name="numberOfRooms",
     *          in="query",
     *          description="Number of rooms in the school",
     *          required=false,
     *          @OA\Schema(type="integer", minimum=1)
     *      ),
     *      @OA\Parameter(
     *          name="province",
     *          in="query",
     *          description="Province where the school is located",
     *          required=false,
     *         @OA\Schema(type="string", enum=ProvinceEnum::PROVINCES)
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Success"),
     *              @OA\Property(property="message", type="string", example="School updated successfully")
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Error"),
     *              @OA\Property(property="message", type="string", example="Invalid input data")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Error"),
     *              @OA\Property(property="message", type="string", example="School not found")
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Error"),
     *              @OA\Property(property="message", type="string", example="Internal Server Error")
     *          )
     *      )
     * )
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'numberOfRooms' => 'sometimes|required|integer|min:1',
            'province' => 'sometimes|required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'Error', 'message' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $school = School::find($id);
        if(!$school)
            return response()->json(['status'=>'Error','message'=>'School not found'],Response::HTTP_NOT_FOUND);

        $school->update($request->all());
        if ($school->wasChanged()) {
            return response()->json(['status' => 'Success', 'message' => 'School updated successfully'], Response::HTTP_OK);
        } else {
            return response()->json(['status' => 'Success', 'message' => 'No changes were made to the school'], Response::HTTP_OK);
        }

    }

   /**
 * @OA\Delete(
 *      path="/schools/{id}",
 *      operationId="delete",
 *      tags={"Schools"},
 *      summary="Delete a specific school by ID",
 *      description="Deletes a school based on ID",
 *      @OA\Parameter(
 *          name="id",
 *          description="School ID",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=204,
 *          description="No content"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="School not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="Error"),
 *              @OA\Property(property="message", type="string", example="School not found")
 *          )
 *      )
 * )
 */

    public function destroy(int $id)
    {
        $school = School::find($id);
        if($school){
            $school->delete();
            return response()->json(['status'=>'Success','message'=>'School deleted'],Response::HTTP_NO_CONTENT);
        }
            return response()->json(['status'=>'Error','message'=>'School not Found'],Response::HTTP_NOT_FOUND);

    }
}

<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserDetailRepository;
use App\Models\UserDetail;
use App\Validators\UserDetailValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class UserDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserDetailRepositoryEloquent extends BaseRepository implements UserDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     */
    public function store($request)
    {
        // Save Company Logo
        if($request->file('logo')){
            $image = $request->file('logo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
        }

        return $this->updateOrCreate(
            ['user_id' => $request->input('user_id')],
            [
                'bio' => $request->input('userDetail.bio'),
                'user_id' => $request->input('user_id'),
                'address' => $request->input('userDetail.address'),
                'timezone' => $request->input('userDetail.timezone'),
                'picture' => ($request->file('logo')) ? $name : $request->input('userDetail.picture'),
                'niche' => $request->input('userDetail.niche'),
                'state_id' => $request->input('userDetail.state_id'),
                'country_id' => $request->input('userDetail.country_id'),
                'website' => $request->input('userDetail.website'),
                'phone' => $request->input('userDetail.phone'),
            ]);

    }
}

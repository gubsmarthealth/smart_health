<?php

namespace App\Http\Repositories\Front;
use Phpml\Classification\KNearestNeighbors;

class PublicRepository extends BaseRepository
{
    public function SeeHaertDiseaseResult($request)
    {
        try {
            $input = $request->input('data');
            $validator = Validator::make($input, [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                $resData = [
                    'status' => 3000,
                    'msg' => trans('app.validation_failed'),
                    'error' => $validator->errors(),
                ];
            } else {
                //Received Data from Users input =========
                $user_data = array(
                    isset($input['age']) ? $input['age'] : 0,
                    isset($input['sex']) ? $input['sex'] : 1,
                    isset($input['cp']) ? $input['cp'] : 1,
                    isset($input['trestbps']) ? $input['trestbps'] : 0,
                    isset($input['chol']) ? $input['chol'] : 1,
                    isset($input['fbs']) ? $input['fbs'] : 0,
                    isset($input['restecg']) ? $input['restecg'] : 1,
                    isset($input['thalach']) ? $input['thalach'] : 0,
                    isset($input['exang']) ? $input['exang'] : 1,
                    isset($input['oldpeak']) ? $input['oldpeak'] : 1,
                    isset($input['slope']) ? $input['slope'] : 1,
                    isset($input['ca']) ? $input['ca'] : 1,
                    isset($input['thal']) ? $input['thal'] : 0,
                );

                /// UCI Data Processing Start===========

                $file = public_path('data.txt'); /// Data File.
                $doc = file_get_contents($file); /// Get Data From File
                $line = explode("\n", $doc); /// Generate Array from file Data

                $data = []; /// Array For 13 sign store.
                $result = []; ///Array For result store against sign. 

                foreach ($line as $mainkey => $newline) {
                    $parts = explode(' ', $newline);
                    foreach ($parts as $key => $value) {
                        if ($key + 1 < count($parts)) {
                            $data[$mainkey][$key] = $value; /// Store only Signs
                        } else {
                            $result[] = str_replace("\r", "", $value); ///Store Result
                        }
                    }
                }

                /////=========================////===================================////
                ///” KNearestNeighbors” This is Packeg for PHP Machin Learning, for more details got to link below. 
                //URL: https://github.com/php-ai/php-ml
                //Details URL:  https://php-ml.readthedocs.io/en/latest/machine-learning/classification/k-nearest-neighbors/

                //In this packeg we need to use Data set array and result array against of the dataset, then we find result using Users imputed data.
                /////=========================////===================================////

                $classifier = new KNearestNeighbors(); ///Object of ML
                $classifier->train($data, $result); ///Train with data array and Result array.
                $rsData['result'] = $classifier->predict($user_data); ///Get Result Using Users Data.

                if ($rsData['result'] == 0){
                    $rsData['disease'] = DiseaseSubCategory::where('id', 1)->first()->toArray();
                }
                $rsData['name'] = $request->input('name');
                $resData = [
                    'status' => 2000,
                    'msg' => trans('app.successfully_found'),
                    'data' => $rsData,
                ];
            }
        }catch (\Exception $exception){
            $resData =  [
                'status' => 3000,
                'msg' => trans('app.something_wrong'),
                'error' => $exception->getMessage(),
            ];
        }
        return $resData;  // Return Result
    }
}

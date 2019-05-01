@extends('front.layouts.master')
@section('title','Helth Consuolting')
@section('style')
<style>
    h3 {
        font-size: 18px;
        color: #444343;
    }
</style>
@endsection
@section('content')
    <section class="facilities-area" style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <form class="disease_form" @submit.prevent="SubmitAiData($event)">
                    {{@csrf_field()}}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label><h3>Name:</h3></label>
                            <input type="text" name="name" v-model="FormData.name" class="form-control">
                            <span class="text-danger" v-text="errors.get('name')"></span>
                        </div>
                        <div class="col-md-4">
                            <label><h3>Age:</h3></label>
                            <input type="text" name="age" v-model="FormData.age" class="form-control">
                            <span class="text-danger" v-text="errors.get('age')"></span>
                        </div>
                        <div class="col-md-2">
                            <label><h3>Gender:</h3></label>
                            <select class="form-control" name="sex">
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                            <span class="text-danger" v-text="errors.get('age')"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h3 >Have you chest pain? if have Select pain Type:</h3>
                            <label class="radio-inline">
                                <input name="cp" v-model="FormData.cp" type="radio" value="1">None
                            </label></label>
                            <label class="radio-inline">
                                <input name="cp" v-model="FormData.cp" type="radio" value="2">Low
                            </label></label>
                            <label class="radio-inline">
                                <input name="cp" v-model="FormData.cp" type="radio" value="3">Middle
                            </label></label>
                            <label class="radio-inline">
                                <input name="cp" v-model="FormData.cp" type="radio" value="4">High
                            </label></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h3>Resting electrocardiographic results:</h3>
                            <label class="radio-inline">
                                <input name="restecg" v-model="FormData.restecg" type="radio" value="0">Normal
                            </label></label>
                            <label class="radio-inline">
                                <input name="restecg" v-model="FormData.restecg" type="radio" value="2">Low
                            </label></label>
                            <label class="radio-inline">
                                <input name="restecg" v-model="FormData.restecg" type="radio" value="3">High
                            </label></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <h3>Serum cholestoral in mg/dl :</h3>
                            <label class="radio-inline">
                                <input name="fbs" v-model="FormData.fbs" type="radio" value="0">Normal
                            </label></label>
                            <label class="radio-inline">
                                <input name="fbs" v-model="FormData.fbs" type="radio" value="1">High
                            </label></label>
                        </div>
                        <div class="col-md-6">
                            <h3>Exercise induced angina :</h3>
                            <label class="radio-inline">
                                <input name="exang" v-model="FormData.exang" type="radio" value="0">Yes
                            </label></label>
                            <label class="radio-inline">
                                <input name="exang" v-model="FormData.exang" type="radio" value="1">NO
                            </label></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h3>The slope of the peak exercise ST segment  :</h3>
                            <label class="radio-inline">
                                <input name="slope" v-model="FormData.slope" type="radio" value="1">Upsloping
                            </label></label>
                            <label class="radio-inline">
                                <input name="slope" v-model="FormData.slope" type="radio" value="2">Flat
                            </label></label>
                            <label class="radio-inline">
                                <input name="slope" v-model="FormData.slope" type="radio" value="3">Downsloping
                            </label></label>
                        </div>
                        <div class="col-md-12">
                            <h3>Thal:</h3>
                            <label class="radio-inline">
                                <input name="thal" v-model="FormData.thal" type="radio" value="3">Normal
                            </label></label>
                            <label class="radio-inline">
                                <input name="thal" v-model="FormData.thal" type="radio" value="6">Fixed defect
                            </label></label>
                            <label class="radio-inline">
                                <input name="thal" v-model="FormData.thal" type="radio" value="7">Reversable defect
                            </label></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label><h3>ng blood sugar > 120 mg/dl :</h3></label>
                            <label class="radio-inline">
                                <input name="fbs" v-model="FormData.fbs" type="radio" value="0">Normal
                            </label></label>
                            <label class="radio-inline">
                                <input name="fbs" v-model="FormData.fbs" type="radio" value="1">High
                            </label></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label><h3>um heart rate achieved :</h3></label>
                            <input type="text" v-model="FormData.thalach" name="thalach" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label><h3> cholestoral in mg/dl :</h3></label>
                            <input type="text" v-model="FormData.chol" name="chol" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label><h3>r of major vessels (0-3) colored by flourosopy :</h3></label>
                            <input type="text" v-model="FormData.ca" name="ca" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label><h3>ng blood pressure (in mm Hg on admission to the hospital) :</h3></label>
                            <select class="form-control"  v-model="FormData.trestbps" name="trestbps">
                                <option value="1">Normal</option>
                                <option value="2">Low</option>
                                <option value="3">High</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label><h3> ST depression induced by exercise relative to rest :</h3></label>
                            <input type="text" name="oldpeak" v-model="FormData.oldpeak" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">See Result</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Heart Disease Result</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <p v-if="parseInt(resultData.result) === 0"><span v-text="resultData.name"></span> Your result is : <span v-text="resultData.result"></span>, That means You are not risk in Heart disease.</p>
                        <p v-else-if="parseInt(resultData.result) === 1"><span v-text="resultData.name"></span> Your result is : <span v-text="resultData.result"></span>, That means You are in risk in Heart disease disease.</p>
                        <p v-else-if="parseInt(resultData.result) === 2"><span v-text="resultData.name"></span> Your result is : <span v-text="resultData.result"></span>, That means You are in  Heart disease.</p>
                        <p v-else-if="parseInt(resultData.result) === 3"><span v-text="resultData.name"></span> Your result is : <span v-text="resultData.result"></span>, That means You are in Heart disease at dangerous stage..</p>
                        <p v-else-if="parseInt(resultData.result) === 3"><span v-text="resultData.name"></span> Your result is : <span v-text="resultData.result"></span>, That means You are in Last Stage of Heart disease</p>
                    <br><br>
                        <a class="btn btn-primary" href="{{route('front.heart.disease')}}">Check Again</a>
                    {{--<div style="margin-top: 20px" v-if="parseInt(resultData.result) > 0">--}}
                    <div style="margin-top: 20px">
                        <a style="color: #FFF;" @click="GetDoctorList()" class="btn btn-primary">Take Doctor Appointment</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="DoctorListModel" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 75%; max-width: 100%">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Available Doctors For Heart Disease</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="AllDoctorList.length > 0" v-for="(item, index) in AllDoctorList">
                                <td>
                                    <div style="margin: 0 auto">
                                        <img style="height: 100px" v-bind:src="'{{env('STORAGE_URL')}}/image/'+item.avatar">
                                    </div>
                                </td>
                                <td v-text="item.name"></td>
                                <td>
                                    <div v-if="item.doctor_details !== undefined && item.doctor_details !== null">
                                        <span v-html="item.doctor_details.details"></span>
                                    </div>
                                </td>
                                <td><a class="btn btn-success" @click="SelectDoctorForDisease(item)"><i class="fa fa-eye"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ env('PUBLIC_PATH')}}/front/js/vue/heart_disease.js"></script>
@endsection

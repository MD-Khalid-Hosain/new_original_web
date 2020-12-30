@extends('backend.master')

@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
@endsection

@section('title')
  Sub Section Item List
@endsection

@section('section_settings_active')
active open
@endsection
@section('sub_section_active')
    active
@endsection
@section('sub_section_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Section</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Sub Section</strong> List </h2>
                        </div>
                        <div class="body">
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Section Name</th>
                                            <th>Sub Section Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getSubSections as $SubSections)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $SubSections->section_id }}</td>
                                            <td>{{ $SubSections->sub_section_name }}</td>
                                            <td>
                                                @if ($SubSections->status == 1)
                                                    <a class="updateSubSectionStatus" id="subSection-{{ $SubSections->id }}" subSection_id="{{ $SubSections->id }}" href="javascript:void(0)" style="color:green">Active</a>
                                                    @else
                                                    <a class="updateSubSectionStatus" id="subSection-{{ $SubSections->id }}" subSection_id="{{ $SubSections->id }}" href="javascript:void(0)" style="color:red">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/edit-subSection') }}/{{ $SubSections->id }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDelete" record="subSection" recordid="{{ $SubSections->id }}"><i class="zmdi zmdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                   <div class="card">
                       <div class="header">
                           <h2><strong>Add Sub Section</strong></h2>
                       </div>
                       <div class="body">
                           <form name="subSectionForm" id="subSectionForm" action="{{ url('admin/add-subSection') }}" method="POST" >
                               @csrf
                               <div class="row clearfix">
                                   <div class="col-md-12">
                                       <label for="section_id">Select Section</label><span class="required">*</span>
                                       <select name="section_id" id="section_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                           <option value="">Select</option>
                                           @foreach ($getSections as $section)
                                           <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                           @endforeach
                                       </select>
                                       @error ('section_id')
                                           <small class="text-danger">{{ $message }}</small>
                                       @enderror
                                   </div>
                                   <div class="col-md-12 mt-5">
                                       <label for="sub_Section_name">Section Sub Item</label><span class="required">*</span>
                                       <div class="form-group">
                                           <input type="text" name="sub_section_name" class="form-control" id="sub_Section_name" value="{{ old('sub_Section_name') }}" >
                                           @error ('sub_Section_name')
                                            <small class="text-danger">{{ $message }}</small>
                                           @enderror
                                       </div>
                                   </div>
                               </div>
                               <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                           </form>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_section')
<script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
@endsection

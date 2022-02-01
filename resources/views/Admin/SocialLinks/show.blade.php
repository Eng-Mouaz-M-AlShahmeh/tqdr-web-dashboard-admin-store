@extends('Admin.Dashboard.layouts.master')

@section('title', 'تفاصيل وسائل التواصل الاجتماعي')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb pull-right">
                <li>
                    <a href="{{ route('admin.dashboard.index',[app()->getLocale()]) }}">الرئيسية</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.sociallinks.index',[app()->getLocale()]) }}">وسائل التواصل الاجتماعي</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>تفاصيل وسائل التواصل الاجتماعي</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">تفاصيل وسائل التواصل الاجتماعي
        </h1>

        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption pull-right">
                            <h5> المعلومات الرئيسية </h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> فيسبوك </th>
                                        <th> تويتر </th>
                                        <th> انستاغرام </th>
                                        <th> لينكيدإن </th>
                                        <th> يوتيوب </th>
                                        <th> تاريخ الإنشاء </th>
                                        <th> تاريخ التعديل </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> {{ $record->facebook }} </td>
                                        <td> {{ $record->twitter }} </td>
                                        <td> {{ $record->instagram }} </td>
                                        <td> {{ $record->linkedin }} </td>
                                        <td> {{ $record->youtube }} </td>
                                        <td> {{ $record->created_at }} </td>
                                        <td> {{ $record->updated_at }} </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>

    </div>
@endsection

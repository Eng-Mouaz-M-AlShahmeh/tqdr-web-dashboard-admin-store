@extends('Front.layouts.master')

@section('title', 'مزودو الخدمة')

@section('header')
    @include('Front.layouts.head')
@endsection

@section('content')
    <div style="margin-top: 50px; margin-bottom: 50px;" class="container">
        <div style="background: #f5f5f5; padding: 25px;" class="container">
            <div class="row justify-content-between">
                
                   <div class="col-md-3 col-lg-3 col-sm-12 text-center">
                     <form name="" action="{{ route('front.serviceproviderssearch', [app()->getLocale()] ) }}" method="post">
                        @csrf <!-- {{ csrf_field() }} -->
                                
                    <div class="input-group rounded">
                      <input type="search" name="key" class="form-control rounded" placeholder="&#128270; {{ __('translate.SearchServiceProvider') }} " aria-label="SearchServiceProvider"
                      aria-describedby="search-addon" />
                    </div>
                    
                    <input type="submit" style="visibility: hidden;" />
                    
                    </form>
                </div>
                
                
                <div class="col-md-9 col-lg-9 col-sm-12 text-center">
                     <h2 style="color: black;">{{ __('translate.ServiceProvider') }}</h2>
                </div>
                
                
             
                
            </div>
           
           
               



<script type="text/javascript">
  $(function () {
    $("form").each(function () {
      $(this)
        .find("input")
        .keypress(function (e) {
          if (e.which == 10 || e.which == 13) {
            this.form.submit();
          }
        });
      $(this).find("input[type=submit]").hide();
    });
  });
</script>
           
                <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 20px;">
                <div class="portlet-body">
                    
                    
                    
                    
                     @if(!(is_countable($serviceprovider) && count($serviceprovider) > 0 ))
                                
                                <tr>
                                    <p>
                                لا يوجد بيانات تطابق بحثك عن 
                                {{ $key }}
                                    </p>
                                </tr>
                                @else
                                
                                
                                <tr>
                                    <p>
                                نتائج بحثك عن 
                                {{ $key }}
                                    </p>
                                </tr>
                                
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr >
                                    <th class="text-center" >
                                    {{ __('translate.ServiceProviderName') }}
                                    </th>
                                    <th class="text-center" >
                                    {{ __('translate.ServiceProviderMobile') }}
                                    </th>
                                    
                                     <th class="text-center" >
                                    {{ __('translate.ServiceProviderNH') }}
                                    </th>
                                    
                                     <th class="text-center" >
                                    {{ __('translate.ServiceProviderLocation') }}
                                    </th>
                                </tr>
                            </thead> 
                            <tbody>
                               
                                
                                 @foreach ($serviceprovider as $serviceProviderr)
                                    <tr>
                                        <td>
                                            {{ $serviceProviderr->storeName }}
                                        </td>
                                        <td>
                                            {{ $serviceProviderr->phone }}
                                        </td>
                                        <td>
                                            {{ $serviceProviderr->nighborhood }}
                                        </td>
                                        <td>
                                            <a href='{{ $serviceProviderr->locationURL }}' target="_blank" style="font-size: 20px;">
                                                  &#127757;  
                                            </a>
                                        </td>
                                    </tr>   
                                @endforeach
                                
                              
                               
                            </tbody>
                        </table>
                    </div>
                    
                      @endif
                      
                </div>
            </div>
            
            
            
        </div>
    </div>
@endsection
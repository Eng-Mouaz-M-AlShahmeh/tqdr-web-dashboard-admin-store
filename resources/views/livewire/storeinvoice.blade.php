<div>

            <div class="col-md-4 col-lg-4 col-sm-12">
                <h2 class="text-center"
                    style="color: black; margin-top: 100px; margin-bottom: 20px; font-size: 15px">{{ __('translate.MobileNumber') }}</h2>
                    
                    <input type="text" class="form-control" 
                        wire:model="phone" placeholder="05xxxxxxxx"/>
                        
            </div>
            
            
           {{--    <div class="col-md-3 col-lg-3 col-sm-12">
                <h2 class="text-center"
                    style="color: white; margin-top: 100px; margin-bottom: 20px; font-size: 15px">{{ __('translate.SelectStore') }}</h2>
                    
                    <select wire:model="store" id="store" class="form-control">
                        
                       @foreach (\App\Models\Store::where('status', '1')->get() as $store)
                      <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                       @endforeach
                       
                    </select>
                    
            </div>  --}}
            
            <input type="hidden" class="form-control" wire:model="store" />
            
            
            
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h2 class="text-center"
                    style="color: black; margin-top: 100px; margin-bottom: 20px; font-size: 15px">{{ __('translate.Amount') }}</h2>
                    
                    <input type="text" class="form-control" 
                        wire:model="amount" placeholder="{{ __('translate.enterValue') }}"/>

            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h2 class="text-center"
                    style="color: black; margin-top: 100px; margin-bottom: 20px; font-size: 15px">{{ __('translate.OrderNumber') }}</h2>
                    
                     
                   
                    <div class="col-md-9 col-lg-9 col-sm-9">
                    <input type="text" class="form-control" wire:model="order_number.0" placeholder="000-0000"/>
                    </div>
                    
                    <div class="col-md-3 col-lg-3 col-sm-3">
                         <div class="tooltipp">
                            <button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">+</button> 
                   
                            <span class="tooltiptextt">للدفع بأكثر من رقم طلب</span>
                        </div>
                   </div>
                   
                   
                        @foreach($inputs as $key => $value)

                       
                       
                       <div class="col-md-9 col-lg-9 col-sm-9">
                       <input type="text" class="form-control" wire:model="order_number.{{ $value }}" placeholder="000-0000"/>
                       </div>
                       
                       <div class="col-md-3 col-lg-3 col-sm-3">
                       <button class="btn text-white btn-danger btn-sm" wire:click.prevent="remove({{ $key }})">-</button> 
                       </div>
                       
                       
                       @endforeach
                   
            </div>
            <div style="margin-top: 100px; margin-bottom: 50px;" class="col-md-12 col-lg-12 col-sm-12">
                <div class="text-center">.
                <button class="p-5 btn btn-warning" wire:click.prevent="pay()">
                    {{ __('translate.Send') }}
                </button>

                </div>
            </div>
            
            
            @if($errorpay != '')
                <div style="margin-top: 10px; margin-bottom: 10px;" class="col-md-12 col-lg-12 col-sm-12">
                    <div class="alert alert-danger" role="alert">
                            {{ $errorpay }}
                    </div>
                </div>
            @endif
            
            @if($successpay != '')
                <div style="margin-top: 10px; margin-bottom: 10px;" class="col-md-12 col-lg-12 col-sm-12">
                    <div class="alert alert-success" role="alert">
                            {{ $successpay }}
                    </div>
                </div>
            @endif
            
            @if($infopay != '')
                <div style="margin-top: 10px; margin-bottom: 10px;" class="col-md-12 col-lg-12 col-sm-12">
                    <div class="alert alert-info" role="alert">
                            {{ $infopay }}
                    </div>
                </div>
            @endif
        

</div>
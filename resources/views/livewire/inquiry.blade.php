<div>
   
   
    <div class="modal fade" id="exampleModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                         
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('translate.InquireAboutBalance') }}</h5>
                              
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                         
                        
                </div>
                <div class="modal-body" style="margin-top: 15px; margin-bottom: 15px;">
                        
                        
                   
                    <div class="col-md-6 col-lg-6 col-sm-12 pull-right">
                      <h2 style="color: black; font-size: 15px;">{{ __('translate.OrderNumber') }}</h2>
                        
                    </div>
                           
                    <div class="col-md-6 col-lg-6 col-sm-12 pull-right">
                        
                        <input type="text" class="form-control" 
                        wire:model="invoiceId" placeholder="000-0000"/>
                        
                        
                
                    </div>
                
                    <br/>  <br/>  
            
                </div>
                      
                      
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('translate.Cancel') }}</button>
                    
                    <button type="button" class="p-5 btn btn-warning" wire:click.prevent="balanceInquiry()">{{ __('translate.Inquire') }}</button>

                    @if($amount != '')
                    <div style="margin-top: 10px; margin-bottom: 10px;" class="col-md-12 col-lg-12 col-sm-12">
                        <div class="alert alert-info" role="alert">
                            {{ $amount }}
                        </div>
                    </div>
                    @endif
                </div>
                      
                      
            </div>
        </div>
    </div>
                
                
</div>

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;

class Inquiry extends Component
{
    public $invoiceId, $amount;
    
    public function render()
    {
        return view('livewire.inquiry');
    }
    
    private function resetInputFields() {
        $this->invoiceId = '';
        $this->amount = '';
    }
    
    public function balanceInquiry() {
        $this->amount = '';
        if($this->invoiceId === null) {
            $this->amount = '';
            $amountval = 'رقم الإيصال مطلوب!';
            $this->amount = $amountval;
        }
        
        $record = Invoice::where('id', '=', $this->invoiceId)->first();
        if ($record === null) {
            $text = 'هذا الايصال غير صالح';
            $this->amount = $text;
        } else {
            $invoiceRem = Invoice::where('id',$this->invoiceId)->first()->remaining_amount;
            $this->amount = '';
            $amountval = 'المبلغ المتبقي في الإيصال رقم '.$this->invoiceId.' هو '.$invoiceRem. ' ريال ';
            $this->amount = $amountval;
        }
        
    }
    
}

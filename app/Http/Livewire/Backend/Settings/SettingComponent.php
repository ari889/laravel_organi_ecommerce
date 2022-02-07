<?php

namespace App\Http\Livewire\Backend\Settings;

use Livewire\Component;
use App\Models\Settings;

class SettingComponent extends Component
{
    public $email;
    public $phone;
    public $address;
    public $footerText;
    public $facebook;
    public $twitter;
    public $instagram;
    public $pinterest;

    public function mount(){
        $settings = new Settings();

        if($settings->where('name', 'email')->count() > 0){
            $this->email = $settings->where('name', 'email')->first()->value;
        }

        if($settings->where('name', 'phone')->count() > 0){
            $this->phone = $settings->where('name', 'phone')->first()->value;
        }

        if($settings->where('name', 'address')->count() > 0){
            $this->address = $settings->where('name', 'address')->first()->value;
        }

        if($settings->where('name', 'footer_text')->count() > 0){
            $this->footerText = $settings->where('name', 'footer_text')->first()->value;
        }

        if($settings->where('name', 'facebook')->count() > 0){
            $this->facebook = $settings->where('name', 'facebook')->first()->value;
        }

        if($settings->where('name', 'twitter')->count() > 0){
            $this->twitter = $settings->where('name', 'twitter')->first()->value;
        }

        if($settings->where('name', 'instagram')->count() > 0){
            $this->instagram = $settings->where('name', 'instagram')->first()->value;
        }

        if($settings->where('name', 'pinterest')->count() > 0){
            $this->pinterest = $settings->where('name', 'pinterest')->first()->value;
        }


    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'email'      => 'required|email',
            'phone'      => 'required',
            'address'    => 'nullable|string',
            'footerText' => 'nullable|string',
            'facebook'   => 'nullable|string',
            'twitter'    => 'nullable|string',
            'instagram'  => 'nullable|string',
            'pinterest'  => 'nullable|string'
        ]);
    }

    public function updateSetting(){
        $this->validate([
            'email'      => 'required|email',
            'phone'      => 'required',
            'address'    => 'nullable|string',
            'footerText' => 'nullable|string',
            'facebook'   => 'nullable|string',
            'twitter'    => 'nullable|string',
            'instagram'  => 'nullable|string',
            'pinterest'  => 'nullable|string'
        ]);

        $settings = new Settings();


        /**
         * insert or update email
         */
        if($settings->where('name', 'email')->count() > 0){
            $settings->where('name', 'email')->update([
                'name' => 'email',
                'value' => $this->email
            ]);
        }else{
            $settings->create([
                'name' => 'email',
                'value' => $this->email
            ]);
        }

        /**
         * insert or update phone
         */
        if($settings->where('name', 'phone')->count() > 0){
            $settings->where('name', 'phone')->update([
                'name' => 'phone',
                'value' => $this->phone
            ]);
        }else{
            $settings->create([
                'name' => 'phone',
                'value' => $this->phone
            ]);
        }

        /**
         * insert or update address
         */
        if($this->address != null){
            if($settings->where('name', 'address')->count() > 0){
                $settings->where('name', 'address')->update([
                    'name' => 'address',
                    'value' => $this->address
                ]);
            }else{
                $settings->create([
                    'name' => 'address',
                    'value' => $this->address
                ]);
            }
        }

        /**
         * insert or update footer_text
         */
        if($this->footerText != null){
            if($settings->where('name', 'footer_text')->count() > 0){
                $settings->where('name', 'footer_text')->update([
                    'name' => 'footer_text',
                    'value' => $this->footerText
                ]);
            }else{
                $settings->create([
                    'name' => 'footer_text',
                    'value' => $this->footerText
                ]);
            }
        }

        /**
         * insert or update facebook
         */
        if($this->facebook != null){
            if($settings->where('name', 'facebook')->count() > 0){
                $settings->where('name', 'facebook')->update([
                    'name' => 'facebook',
                    'value' => $this->facebook
                ]);
            }else{
                $settings->create([
                    'name' => 'facebook',
                    'value' => $this->facebook
                ]);
            }
        }

        /**
         * insert or update twitter
         */
        if($this->twitter != null){
            if($settings->where('name', 'twitter')->count() > 0){
                $settings->where('name', 'twitter')->update([
                    'name' => 'twitter',
                    'value' => $this->twitter
                ]);
            }else{
                $settings->create([
                    'name' => 'twitter',
                    'value' => $this->twitter
                ]);
            }
        }

        /**
         * insert or update instagram
         */
        if($this->instagram != null){
            if($settings->where('name', 'instagram')->count() > 0){
                $settings->where('name', 'instagram')->update([
                    'name' => 'instagram',
                    'value' => $this->instagram
                ]);
            }else{
                $settings->create([
                    'name' => 'instagram',
                    'value' => $this->instagram
                ]);
            }
        }

        /**
         * insert or update pinterest
         */
        if($this->pinterest != null){
            if($settings->where('name', 'pinterest')->count() > 0){
                $settings->where('name', 'pinterest')->update([
                    'name' => 'pinterest',
                    'value' => $this->pinterest
                ]);
            }else{
                $settings->create([
                    'name' => 'pinterest',
                    'value' => $this->pinterest
                ]);
            }
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Settings Updated!');


    }

    public function render()
    {
        return view('livewire.backend.settings.setting-component', ['page_title' => 'Settings'])->layout('backend.layouts.app', ['page_title' => 'Settings']);
    }
}

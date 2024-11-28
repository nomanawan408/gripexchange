
<div class="sidebar_cont">
   <div class="w-100 d-flex justify-content-end">
      <button class="close_btn btn btn-light">
        <i class="fas fa-times"></i>
      </button>
   </div>
  
  <div class="menus">
    <ul class="menu_list">
      <a href="{{URL::to('/dashboard')}}">
        <li class=" {{ Route::is('dashboard.index') ? 'active_menu' : '' }}">Home</li>
      </a>

      @can('deposit funds')
      <a href="{{URL::to('/deposit')}}">
        <li class="{{ Route::is('deposit.index') ? 'active_menu' : '' }}">Deposit</li>
      </a>
      @endcan 
      
      @can('withdraw funds')
      <a href="{{URL::to('/withdraw')}}">
        <li class="{{ Route::is('withdraw.index') ? 'active_menu' : '' }}">Withdraw</li>
      </a>
      @endcan     
                        {{-- <a href="{{URL::to('/internaltransfer')}}">
        <li class="{{ Route::is('internal-transfer.index') ? 'active_menu' : '' }}">Internal transfer</li>
      </a> --}}
      @can('create payment methods')
      <a href="{{URL::to('/paymentmethod')}}">
        <li class="{{ Route::is('paymentmethod.index') ? 'active_menu' : '' }}">Payment Methods</li>
      </a>
      @endcan

  
      <a href="{{URL::to('/account-statements')}}">
        <li class="{{ Route::is('account-statements.index') ? 'active_menu' : '' }}">Account statement</li>
      </a>
      
     
      {{-- <a href="{{URL::to('/currency-exchange')}}">
        <li class="{{ Route::is('currency-exchange.index') ? 'active_menu' : '' }}">Exchange Currency</li>
      </a>
      <a href="{{URL::to('/exchange-rates')}}">
        <li class="{{ Route::is('exchange.index') ? 'active_menu' : '' }}">Exchange Rates</li>
      </a> --}}
      <a href="{{URL::to('/invite')}}">
        <li class="{{ Route::is('invite.index') ? 'active_menu' : '' }}">Invite and Earn</li>
      </a>
      <div class="dropdown">
        <a href="{{URL::to('/verification')}}">
        <li class="{{ Route::is('verification.index') ? 'active_menu' : '' }}">Verification</li>
      </a>
      @can('manage users')
        <a href="{{URL::to('/users')}}">
          <li class="{{ Route::is('users.index') ? 'active_menu' : '' }}">Users</li>
        </a>
      @endcan
      <a href="{{URL::to('/profile')}}">
        <li class="{{ Route::is('profile.index') ? 'active_menu' : '' }}">Profile</li>
      </a>
      @can('update system settings')
      <a href="{{URL::to('/contact-us/show')}}">
        <li class="{{ Route::is('contact-us.show') ? 'active_menu' : '' }}">Contact Quries</li>
      </a>
      <a href="{{URL::to('/settings')}}">
        <li class="{{ Route::is('settings.index') ? 'active_menu' : '' }}">Settings</li>
      </a>
      @endcan
    
    </ul>
  </div>
</div>
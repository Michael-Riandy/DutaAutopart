<div class="header-dashboard">
  <div class="wrap">
      <div class="header-left">
          <div class="button-show-hide">
              <i class="icon-menu-left"></i>
          </div>
          <form class="form-search flex-grow">
              <fieldset class="name">
                  <input type="text" placeholder="Search here..." class="show-search" id="search-input" name="name" tabindex="2" value="" aria-required="true" required="" autocomplete="off">
              </fieldset>
              <div class="button-submit">
                
                  <button class="" type="submit"><i class="icon-search"></i></button>
              </div>
              <div class="box-content-search" id="box-content-search">
                  <ul id="search-input">

                  </ul>
              </div>
          </form>

      </div>
      <div class="header-grid">
          <div class="popup-wrap message type-header">
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="header-item">
                          <span class="text-tiny">1</span>
                          <i class="icon-bell"></i>
                      </span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end has-content"
                      aria-labelledby="dropdownMenuButton2">
                    @if($lowStockProducts->count() > 0)
                        <div class="alert">
                            <h4><strong>⚠️ Notifikasi Stok Rendah!</strong></h4>
                            <ul>
                                @foreach($lowStockProducts as $product)
                                 <li>
                                    <div class="message-item item-3">
                                        <div class="image">
                                            <i class="icon-noti-3"></i>
                                        </div>
                                        <div>
                                            <p class="body-title-2">
                                                {{ $product->name }}
                                                <br>Sisa stok: {{ $product->quantity }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                  </ul>
              </div>
          </div>




          <div class="popup-wrap user type-header">
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button"
                      id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="header-user wg-user">
                          <span class="image">
                              <img src="{{ asset('assets/images/about/about-2.jpg') }}" alt="">
                          </span>
                          <span class="flex flex-column">
                              <span class="body-title mb-2">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                              <!-- <span class="text-tiny">Admin</span> -->
                          </span>
                      </span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end has-content"
                      aria-labelledby="dropdownMenuButton3">
                      {{-- <li>
                          <a href="#" class="user-item">
                              <div class="icon">
                                  <i class="icon-user"></i>
                              </div>
                              <div class="body-title-2">Account</div>
                          </a>
                      </li>
                      <li>
                          <a href="#" class="user-item">
                              <div class="icon">
                                  <i class="icon-mail"></i>
                              </div>
                              <div class="body-title-2">Inbox</div>
                              <div class="number">27</div>
                          </a>
                      </li>
                      <li>
                          <a href="#" class="user-item">
                              <div class="icon">
                                  <i class="icon-file-text"></i>
                              </div>
                              <div class="body-title-2">Taskboard</div>
                          </a>
                      </li>
                      <li>
                          <a href="#" class="user-item">
                              <div class="icon">
                                  <i class="icon-headphones"></i>
                              </div>
                              <div class="body-title-2">Support</div>
                          </a>
                      </li> --}}
                      <li>
                        <form method="POST" action="{{route('logout')}}" id="logout-form">
                        @csrf
                          <a href="{{route('logout')}}" class="user-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                              <div class="icon">
                                  <i class="icon-log-out"></i>
                              </div>
                              <div class="body-title-2">Log out</div>
                          </a>
                        </form>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</div>
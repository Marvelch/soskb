<!DOCTYPE html>
<html lang="en">
   @include('tamplate.head')
   <body class="fixed-bottom-padding">
      <!-- <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div> -->
      <!-- home page -->
      <div class="osahan-home-page">
         <div class="border-bottom p-3">
            <div class="title d-flex align-items-center">
               <a href="home.html" class="text-decoration-none text-dark d-flex align-items-center">
                  <img class="osahan-logo me-2" src="img/logo.png">
               </a>
               <p class="ms-auto m-0">
                  <a href="notification.html" class="text-decoration-none bg-white p-1 rounded shadow-sm d-flex align-items-center">
                  <i class="text-dark icofont-notification"></i>
                  <span class="badge badge-danger p-1 ms-1 small">2</span>
                  </a>
               </p>
               <a class="toggle ms-3" href="#"><i class="icofont-navigation-menu "></i></a>
            </div>
            <a href="search.html" class="text-decoration-none">
               <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
                  <div class="input-group-prepend">
                     <button class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>
                  </div>
                  <input type="text" class="shadow-none border-0 form-control ps-0" placeholder="Search for Products.." aria-label="" aria-describedby="basic-addon1">
               </div>
            </a>
         </div>
         <!-- body -->
         <div class="osahan-body">
            <!-- categories -->
            <div class="p-3 osahan-categories">
               <h6 class="mb-2">Layanan Tersedia</h6>
               <div class="row m-0">
                  <div class="col ps-0 pe-1 py-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="{{route('index_sales_orders')}}">
                           <img src="https://cdn3d.iconscout.com/3d/premium/thumb/cash-on-delivery-9237918-7525528.png" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Sales Order</p>
                        </a>
                     </div>
                  </div>
                  <div class="col p-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="{{route('index_products')}}">
                           <img src="https://cdn3d.iconscout.com/3d/premium/thumb/analyze-product-4889671-4076848.png" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Products</p>
                        </a>
                     </div>
                  </div>
                  <div class="col p-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="{{route('transaction_sales_orders')}}">
                           <img src="https://cdn3d.iconscout.com/3d/premium/thumb/wallet-security-8860121-7300054.png" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Transaction</p>
                        </a>
                     </div>
                  </div>
                  <div class="col ps-0 pe-1 py-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="{{route('index_customers')}}">
                           <img src="https://cdn3d.iconscout.com/3d/premium/thumb/customer-satisfaction-8094133-6478780.png" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Customers</p>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- <div class="row m-0">
                  <div class="col ps-0 pe-1 py-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.html">
                           <img src="img/categorie/5.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Milk & Egg</p>
                        </a>
                     </div>
                  </div>
                  <div class="col p-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.html">
                           <img src="img/categorie/6.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Bread</p>
                        </a>
                     </div>
                  </div>
                  <div class="col p-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.html">
                           <img src="img/categorie/7.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Frozen</p>
                        </a>
                     </div>
                  </div>
                  <div class="col ps-0 pe-1 py-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.html">
                           <img src="img/categorie/8.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Organic</p>
                        </a>
                     </div>
                  </div>
               </div> -->
            </div>
            <!-- Promos -->
            <!-- <div class="py-3 bg-white osahan-promos shadow-sm">
               <div class="d-flex align-items-center px-3 mb-2">
                  <h6 class="m-0">Promos for you</h6>
                  <a href="promos.html" class="ms-auto text-success">See more</a>
               </div>
               <div class="promo-slider">
                  <div class="osahan-slider-item m-2">
                     <a href="promo_details.html"><img src="img/promo1.jpg" class="img-fluid mx-auto rounded" alt="Responsive image"></a>
                  </div>
                  <div class="osahan-slider-item m-2">
                     <a href="promo_details.html"><img src="img/promo2.jpg" class="img-fluid mx-auto rounded" alt="Responsive image"></a>
                  </div>
                  <div class="osahan-slider-item m-2">
                     <a href="promo_details.html"><img src="img/promo3.jpg" class="img-fluid mx-auto rounded" alt="Responsive image"></a>
                  </div>
               </div>
            </div> -->
            <!-- Pick's Today -->
            <!-- <div class="title d-flex align-items-center mb-3 mt-3 px-3">
               <h6 class="m-0">Pick's Today</h6>
               <a class="ms-auto text-success" href="picks_today.html">See more</a>
            </div> -->
            <!-- pick today -->
            <!-- <div class="pick_today px-3">
               <div class="row">
                  <div class="col-6 pe-2">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              <div class="member-plan position-absolute"><span class="badge m-3 badge-danger">10%</span></div>
                              <div class="p-3">
                                 <img src="img/listing/v1.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Chilli</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$0.8/kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 ps-2">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              <div class="member-plan position-absolute"><span class="badge m-3 badge-danger">5%</span></div>
                              <div class="p-3">
                                 <img src="img/listing/v2.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Onion</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$1.8/kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row pt-3">
                  <div class="col-6 pe-2">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              <div class="member-plan position-absolute"><span class="badge m-3 badge-warning">5%</span></div>
                              <div class="p-3">
                                 <img src="img/listing/v3.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Tomato</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$1/kg</h6>
                           <a class="ms-auto" href="cart.html">
                           <div class="input-group input-spinner ms-auto cart-items-number">
                           <div class="input-group-prepend">
                           <button class="btn btn-success btn-sm" type="button" id="button-plus"> + </button>
                           </div>
                           <input type="text" class="form-control" value="1">
                           <div class="input-group-append">
                           <button class="btn btn-success btn-sm" type="button" id="button-minus"> − </button>
                           </div>
                           </div>
                           </a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 ps-2">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              <div class="member-plan position-absolute"><span class="badge m-3 badge-warning">15%</span></div>
                              <div class="p-3">
                                 <img src="img/listing/v4.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Cabbage</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$0.8/kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row pt-3">
                  <div class="col-6 pe-2">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              <div class="member-plan position-absolute"><span class="badge m-3 badge-success">10%</span></div>
                              <div class="p-3">
                                 <img src="img/listing/v5.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Cauliflower</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$1.8/kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 ps-2">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              <div class="member-plan position-absolute"><span class="badge m-3 badge-success">10%</span></div>
                              <div class="p-3">
                                 <img src="img/listing/v6.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Carrot</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$0.8/kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div> -->
            <!-- Most sales -->
            <!-- <div class="title d-flex align-items-center p-3">
               <h6 class="m-0">Recommend for You</h6>
               <a class="ms-auto text-success" href="recommend.html">26 more</a>
            </div> -->
            <!-- osahan recommend -->
            <!-- <div class="osahan-recommend px-3">
               <div class="row">
                  <div class="col-12 mb-3">
                     <a href="product_details.html" class="text-dark text-decoration-none">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="recommend-slider rounded pt-2">
                              <div class="osahan-slider-item m-2 rounded">
                                 <img src="img/recommend/r1.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              <div class="osahan-slider-item m-2 rounded">
                                 <img src="img/recommend/r2.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              <div class="osahan-slider-item m-2 rounded">
                                 <img src="img/recommend/r3.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                           </div>
                           <div class="p-3 position-relative">
                              <h6 class="mb-1 font-weight-bold text-success">Fresh Orange
                              </h6>
                              <p class="text-muted">Orange Great Quality item from Jamaica.</p>
                              <div class="d-flex align-items-center">
                                 <h6 class="m-0">$8.8/kg</h6>
                     <a class="ms-auto" href="cart.html">
                     <div class="input-group input-spinner ms-auto cart-items-number">
                     <div class="input-group-prepend">
                     <button class="btn btn-success btn-sm" type="button" id="button-plus"> + </button>
                     </div>
                     <input type="text" class="form-control" value="1">
                     <div class="input-group-append">
                     <button class="btn btn-success btn-sm" type="button" id="button-minus"> − </button>
                     </div>
                     </div>
                     </a>
                     </div>
                     </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-12 mb-3">
                     <a href="product_details.html" class="text-dark text-decoration-none">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="recommend-slider rounded pt-2">
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r4.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r5.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r6.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                           </div>
                           <div class="p-3 position-relative">
                              <h6 class="mb-1 font-weight-bold text-success">Green Apple</h6>
                              <p class="text-muted">Green Apple Premium item from Vietnam.</p>
                              <div class="d-flex align-items-center">
                                 <h6 class="m-0">$10.8/kg</h6>
                     <a class="ms-auto" href="cart.html">
                     <div class="input-group input-spinner ms-auto cart-items-number">
                     <div class="input-group-prepend">
                     <button class="btn btn-success btn-sm" type="button" id="button-plus"> + </button>
                     </div>
                     <input type="text" class="form-control" value="1">
                     <div class="input-group-append">
                     <button class="btn btn-success btn-sm" type="button" id="button-minus"> − </button>
                     </div>
                     </div>
                     </a>
                     </div>
                     </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-12 mb-3">
                     <a href="product_details.html" class="text-dark text-decoration-none">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="recommend-slider rounded pt-2">
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r7.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r8.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r9.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                           </div>
                           <div class="p-3 position-relative">
                              <h6 class="mb-1 font-weight-bold text-success">Fresh Apple
                              </h6>
                              <p class="text-muted">Fresh Apple Premium item from Thailand.</p>
                              <div class="d-flex align-items-center">
                                 <h6 class="m-0">$12.8/kg</h6>
                     <a class="ms-auto" href="cart.html">
                     <div class="input-group input-spinner ms-auto cart-items-number">
                     <div class="input-group-prepend">
                     <button class="btn btn-success btn-sm" type="button" id="button-plus"> + </button>
                     </div>
                     <input type="text" class="form-control" value="1">
                     <div class="input-group-append">
                     <button class="btn btn-success btn-sm" type="button" id="button-minus"> − </button>
                     </div>
                     </div>
                     </a>
                     </div>
                     </div>
                     </div>
                     </a>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
      <!-- Footer -->
      @include('layouts.menu')
      <nav id="main-nav">
         <ul class="second-nav">
            <li><a href="index.html"><i class="icofont-smart-phone me-2"></i> Splash</a></li>
            <li>
               <a href="#"><i class="icofont-login me-2"></i> Authentication</a>
               <ul>
                  <li> <a href="account-setup.html">Account Setup</a></li>
                  <li><a href="signin.html">Sign in</a></li>
                  <li><a href="signup.html">Sign up</a></li>
                  <li><a href="verification.html">Verification</a></li>
               </ul>
            </li>
            <li><a href="get_started.html"><i class="icofont-check-circled me-2"></i> Get Started</a></li>
            <li><a href="landing.html"><i class="icofont-paper-plane me-2"></i> Landing</a></li>
            <li><a href="home.html"><i class="icofont-ui-home me-2"></i> Homepage</a></li>
            <li><a href="notification.html"><i class="icofont-notification me-2"></i> Notification</a></li>
            <li><a href="search.html"><i class="icofont-search-1 me-2"></i> Search</a></li>
            <li><a href="listing.html"><i class="icofont-list me-2"></i> Listing</a></li>
            <li><a href="picks_today.html"><i class="icofont-flash me-2"></i> Trending</a></li>
            <li><a href="recommend.html"><i class="icofont-like me-2"></i> Recommend</a></li>
            <li><a href="fresh_vegan.html"><i class="icofont-badge me-2"></i> Most Popular</a></li>
            <li><a href="product_details.html"><i class="icofont-search-document me-2"></i> Product Details</a></li>
            <li><a href="cart.html"><i class="icofont-cart me-2"></i> Cart</a></li>
            <li><a href="order_address.html"><i class="icofont-location-pin me-2"></i> Order Address</a></li>
            <li><a href="delivery_time.html"><i class="icofont-ui-calendar me-2"></i> Delivery Time</a></li>
            <li><a href="order_payment.html"><i class="icofont-money me-2"></i> Order Payment</a></li>
            <li><a href="checkout.html"><i class="icofont-checked me-2"></i> Checkout</a></li>
            <li><a href="successful.html"><i class="icofont-gift me-2"></i> Successful</a></li>
            <li>
               <a href="#"><i class="icofont-sub-listing me-2"></i> My Order</a>
               <ul>
                  <li><a href="complete_order.html">Complete Order</a></li>
                  <li><a href="status_complete.html">Status Complete</a></li>
                  <li><a href="progress_order.html">Progress Order</a></li>
                  <li><a href="status_onprocess.html">Status on Process</a></li>
                  <li><a href="canceled_order.html">Canceled Order</a></li>
                  <li><a href="status_canceled.html">Status Canceled</a></li>
                  <li><a href="review.html">Review</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><i class="icofont-ui-user me-2"></i> My Account</a>
               <ul>
                  <li> <a href="my_account.html">My Account</a></li>
                  <li><a href="edit_profile.html">Edit Profile</a></li>
                  <li><a href="change_password.html">Change Password</a></li>
                  <li><a href="deactivate_account.html">Deactivate Account</a></li>
                  <li><a href="my_address.html">My Address</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><i class="icofont-page me-2"></i> Pages</a>
               <ul>
                  <li> <a href="promos.html">Promos</a></li>
                  <li><a href="promo_details.html">Promo Details</a></li>
                  <li><a href="terms_conditions.html">Terms & Conditions</a></li>
                  <li><a href="privacy.html">Privacy</a></li>
                  <li><a href="terms&conditions.html">Conditions</a></li>
                  <li> <a href="help_support.html">Help Support</a></li>
                  <li>  <a href="help_ticket.html">Help Ticket</a></li>
                  <li>  <a href="refund_payment.html">Refund Payment</a></li>
                  <li>  <a href="faq.html">FAQ</a></li>
               </ul>
            </li>
            <li>
               <a href="#"><i class="icofont-link me-2"></i> Navigation Link Example</a>
               <ul>
                  <li>
                     <a href="#">Link Example 1</a>
                     <ul>
                        <li>
                           <a href="#">Link Example 1.1</a>
                           <ul>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#">Link Example 1.2</a>
                           <ul>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                              <li><a href="#">Link</a></li>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li><a href="#">Link Example 2</a></li>
                  <li><a href="#">Link Example 3</a></li>
                  <li><a href="#">Link Example 4</a></li>
                  <li data-nav-custom-content>
                     <div class="custom-message">
                        You can add any custom content to your navigation items. This text is just an example.
                     </div>
                  </li>
               </ul>
            </li>
         </ul>
         <ul class="bottom-nav">
            <li class="email">
               <a class="text-success" href="home.html">
                  <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
                  Home
               </a>
            </li>
            <li class="github">
               <a href="cart.html">
                  <p class="h5 m-0"><i class="icofont-cart"></i></p>
                  CART
               </a>
            </li>
            <li class="ko-fi">
               <a href="help_ticket.html">
                  <p class="h5 m-0"><i class="icofont-headphone"></i></p>
                  Help
               </a>
            </li>
         </ul>
      </nav>
      @include('tamplate.footer')
   </body>
</html>

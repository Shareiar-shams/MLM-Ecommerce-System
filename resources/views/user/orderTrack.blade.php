@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Track Order
@endsection
@section('user_css_content')
  <style type="text/css" media="screen">
    .steps {
    border: 1px solid #e7e7e7
}

.steps-header {
    padding: .375rem;
    border-bottom: 1px solid #e7e7e7
}

.steps-header .progress {
    height: .25rem
}

.steps-body {
    display: table;
    table-layout: fixed;
    width: 100%
}

.step {
    display: table-cell;
    position: relative;
    padding: 1rem .75rem;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    border-right: 1px dashed #dfdfdf;
    color: rgba(0, 0, 0, 0.65);
    font-weight: 600;
    text-align: center;
    text-decoration: none
}

.step:last-child {
    border-right: 0
}

.step-indicator {
    display: block;
    position: absolute;
    top: .75rem;
    left: .75rem;
    width: 1.5rem;
    height: 1.5rem;
    border: 1px solid #e7e7e7;
    border-radius: 50%;
    background-color: #fff;
    font-size: .875rem;
    line-height: 1.375rem
}

.has-indicator {
    padding-right: 1.5rem;
    padding-left: 2.375rem
}

.has-indicator .step-indicator {
    top: 50%;
    margin-top: -.75rem
}

.step-icon {
    display: block;
    width: 1.5rem;
    height: 1.5rem;
    margin: 0 auto;
    margin-bottom: .75rem;
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    color: #888
}

.step:hover {
    color: rgba(0, 0, 0, 0.9);
    text-decoration: none
}

.step:hover .step-indicator {
    -webkit-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    border-color: transparent;
    background-color: #f4f4f4
}

.step:hover .step-icon {
    color: rgba(0, 0, 0, 0.9)
}

.step-active,
.step-active:hover {
    color: rgba(0, 0, 0, 0.9);
    pointer-events: none;
    cursor: default
}

.step-active .step-indicator,
.step-active:hover .step-indicator {
    border-color: transparent;
    background-color: #5c77fc;
    color: #fff
}

.step-active .step-icon,
.step-active:hover .step-icon {
    color: #5c77fc
}

.step-completed .step-indicator,
.step-completed:hover .step-indicator {
    border-color: transparent;
    background-color: rgba(51, 203, 129, 0.12);
    color: #33cb81;
    line-height: 1.25rem
}

.step-completed .step-indicator .feather,
.step-completed:hover .step-indicator .feather {
    width: .875rem;
    height: .875rem
}

@media (max-width: 575.98px) {
    .steps-header {
        display: none
    }
    .steps-body,
    .step {
        display: block
    }
    .step {
        border-right: 0;
        border-bottom: 1px dashed #e7e7e7
    }
    .step:last-child {
        border-bottom: 0
    }
    .has-indicator {
        padding: 1rem .75rem
    }
    .has-indicator .step-indicator {
        display: inline-block;
        position: static;
        margin: 0;
        margin-right: 0.75rem
    }
}

.bg-secondary {
    background-color: #f7f7f7 !important;
}
  </style>
@endsection

@section('user_main_content')
	<!-- hero area about -->
  <section class="about_hero_area section-padding">
    	<div class="container">
      		<div class="row">
        			<div class="col-md-12">
          				<div class="about_hero_area_content">
            					<h2>Track Order page</h2>
            					
          				</div>
        			</div>
      		</div>
    	</div>
  </section>
  <!-- end hero area about -->
  <!-- main order page -->
  <section class="order_page_section section-padding">
    	<div class="container" style="background: #15979617;">
          <div class="row justify-content-center py-5">
              <div class="col-lg-8">
                  <div class="row">
                      <div class="col-sm-9">
                          <div class="input-group">
                              <input class="form-control" type="text" id="tracking_id" name="tracking_id" placeholder="Tracking Id">
                              {{-- <span class="input-group-addon"><i class="icon-map-pin"></i></span> --}}
                          </div>
                      </div>
                      <div class="col-sm-3 mt-4 mt-sm-0">
                          <button class="btn btn-primary btn-block mt-0" id="submit_number" data-href="{{route('track_request')}}" type="submit"><span>Track Now</span></button>
                      </div>
                  </div>
              </div>
          </div>
          <br><br>
          {{-- <div class='progress' style="">
              <div class='progress_inner'>
                <div class='progress_inner__step'>
                  <label for='step-1'>Pending</label>
                </div>
                <div class='progress_inner__step'>
                  <label for='step-3'>In Progress</label>
                </div>
                <div class='progress_inner__step'>
                  <label for='step-5'>Delivered</label>
                </div>
                <input checked='checked' id='step-1' name='step' type='radio'>
                <input id='step-3' name='step' type='radio'>
                <input id='step-5' name='step' type='radio'>
                <div class='progress_inner__bar'></div>
                <div class='progress_inner__bar--set'></div>
                <div class='progress_inner__tabs'>
                  <div class='tab tab-0'>
                    <h1>Pending Order</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                  </div>
                  <div class='tab tab-3'>
                    <h1>Progress Order</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                  </div>
                  <div class='tab tab-5'>
                    <h1>Deliveried order</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                  </div>
                </div>
                <div class='progress_inner__status'>
                  <div class='box_base'></div>
                  <div class='box_lid'></div>
                  <div class='box_ribbon'></div>
                  <div class='box_bow'>
                    <div class='box_bow__left'></div>
                    <div class='box_bow__right'></div>
                  </div>
                  <div class='box_item'></div>
                  <div class='box_tag'></div>
                  <div class='box_string'></div>
                </div>
              </div>
          </div> --}}
      		<div class="container pb-5 mb-sm-4" id="progress" style="display: none;">
             
              <div class="steps">
                  <div class="steps-header">
                      <div class="progress">
                          <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                  <div class="steps-body">
                      <div class="step" id="step">
                          <span class="" id="indicator" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                              <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                          </span>
                          <span class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                              <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                          </span>Order confirmed
                      </div>
                      

                      <div class="step" id="step">
                          <span class="" id="indicator" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                              <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                          </span>
                          <span class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                              <circle cx="12" cy="12" r="3"></circle>
                              <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                          </span>Processing order
                      </div>
                      <div class="step" id="step">
                          <span class="" id="indicator" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                              <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                          </span>
                          <span class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck">
                              <rect x="1" y="3" width="15" height="13"></rect>
                              <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                              <circle cx="5.5" cy="18.5" r="2.5"></circle>
                              <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                          </span>Product dispatched
                      </div>
                      <div class="step" id="step">
                          <span class="" id="indicator" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                              <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                          </span>
                          <span class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                              <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                          </span>Product delivered
                      </div>

                      <div class="step" id="step" style="display: none;">
                          <span class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                              <path d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/>
                              <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                          </span>Cancel Order
                      </div>
                  </div>
              </div>
          </div>
    		
    	</div>
  </section>
@endsection
@section('user_js_content')

  <script type="text/javascript">
      const trackingInput = document.getElementById('tracking_id');
      const submitButton = document.getElementById('submit_number');
      

      submitButton.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default form submission

        const trackingId = trackingInput.value.trim();

        if (trackingId.length === 0) {
          alert('Please enter a valid tracking ID.');
          return;
        }

        const url = submitButton.dataset.href + '?tracking_id=' + trackingId; // Construct complete URL

        fetch(url)
            .then(response => response.json())
            .then(orderData => updateProgress(orderData)) 
            .catch(error => console.error('Error fetching order data:', error));
      });

      function updateProgress(orderData) {

          if (orderData.error) {
            // Handle error message from backend
            console.error('Error:', orderData.error);
            return;
          }
          const progressContainer = document.querySelector('#progress');

          progressContainer.style.display = ''; // Show progress bar

          const orderStatus = orderData.order.order_status;
          const progressBar = progressContainer.querySelector('#progress-bar');
          const steps = progressContainer.querySelectorAll('#step');
          const indicators = progressContainer.querySelectorAll('#indicator');

          // Reset step classes and progress bar width
          indicators.forEach(indicator => indicator.classList.remove('step-indicator'));
          progressBar.style.width = '0%';
          progressBar.setAttribute('aria-valuenow', 0);

          // Update based on order status
          switch (orderStatus) {
            case 'Pending':
              steps[0].classList.add('step-completed');
              steps[1].classList.add('step-active');
              indicators[0].style.display = '';
              indicators[0].classList.add('step-indicator');
              progressBar.style.width = '40%';
              progressBar.setAttribute('aria-valuenow', 40);
              break;
            case 'Processing_Order':
              steps[0].classList.add('step-completed');
              steps[1].classList.add('step-completed');
              steps[2].classList.add('step-active');
              indicators[0].style.display = '';
              indicators[1].style.display = '';
              indicators[0].classList.add('step-indicator');
              indicators[1].classList.add('step-indicator');
              progressBar.style.width = '60%';
              progressBar.setAttribute('aria-valuenow', 60);
              break;
            case 'Delivery_in_progess': 
              steps[0].classList.add('step-completed');
              steps[1].classList.add('step-completed');
              steps[2].classList.add('step-completed');
              steps[3].classList.add('step-active');
              indicators[0].style.display = '';
              indicators[1].style.display = '';
              indicators[2].style.display = '';
              indicators[0].classList.add('step-indicator');
              indicators[1].classList.add('step-indicator');
              indicators[2].classList.add('step-indicator');
              progressBar.style.width = '80%';
              progressBar.setAttribute('aria-valuenow', 80);
              break;
            case 'Canceled': 
              steps[0].classList.add('step-completed');
              indicators[0].classList.add('step-indicator');
              steps[1].style.display = 'none';
              steps[2].style.display = 'none';
              steps[3].style.display = 'none';
              steps[4].style.display = '';
              steps[4].classList.add('step-active');
              progressBar.style.width = '100%';
              progressBar.setAttribute('aria-valuenow', 100);
              break;
          }
      }
  </script>
@endsection
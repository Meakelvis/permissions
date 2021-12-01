@extends('main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div
      class="d-sm-flex align-items-center justify-content-between mb-4"
    >
      <h1 class="h3 mb-0 text-gray-800">Status Statictics</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
      <!-- Cleared (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-success text-uppercase
                    mb-1
                  "
                >
                  Cleared
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $cleared }}
                </div>
              </div>
              <div class="col-auto">
                {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                <i class="fas fa-thumbs-up fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Rejected (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-danger text-uppercase
                    mb-1
                  "
                >
                  Rejected
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ $rejected }}
                </div>
              </div>
              <div class="col-auto">
                {{-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> --}}
                <i class="fas fa-thumbs-down fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-primary text-uppercase
                    mb-1
                  "
                >
                  Pending
                </div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div
                      class="
                        h5
                        mb-0
                        mr-3
                        font-weight-bold
                        text-gray-800
                      "
                    >
                    {{ $pending }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-exclamation-triangle fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Total No. of Applications
                </div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div
                      class="
                        h5
                        mb-0
                        mr-3
                        font-weight-bold
                        text-gray-800
                      "
                    >
                    {{ $total }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-layer-group fa-2x text-secondary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    {{-- categories --}}
    <h1 class="h3 mb-2 text-gray-800">Category Statistics</h1>
    <div class="row">
      
      <!-- government (Monthly) Card Example -->
      <a href="{{ route('government') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Government
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $government }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- media (Monthly) Card Example -->
      <a href="{{ route('media') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Media
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $media }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- utilities (Monthly) Card Example -->
      <a href="{{ route('utilities') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Utilities
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $utilities }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- manufacturing (Monthly) Card Example -->
      <a href="{{ route('manufacturing') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Manufacturing
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $manufacturing }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- medical (Monthly) Card Example -->
      <a href="{{ route('medical') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Medical
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $medical }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- telecom (Monthly) Card Example -->
      <a href="{{ route('telecom') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Telecom
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $telecom }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- construction (Monthly) Card Example -->
      <a href="{{ route('construction') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Construction
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $construction }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- foodProcessors (Monthly) Card Example -->
      <a href="{{ route('foodProcessors') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Food Processors
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $foodProcessors }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- agriculture (Monthly) Card Example -->
      <a href="{{ route('agriculture') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Agriculture
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $agriculture }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- fuelStations (Monthly) Card Example -->
      <a href="{{ route('fuelStations') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Fuel Stations
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $fuelStations }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- privateSecurity (Monthly) Card Example -->
      <a href="{{ route('privateSecurity') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Private Security
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $privateSecurity }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- deliveryServices (Monthly) Card Example -->
      <a href="{{ route('deliveryServices') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Delivery Services
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $deliveryServices }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- financialInstitutions (Monthly) Card Example -->
      <a href="{{ route('financialInstitutions') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Financial Institutions
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $financialInstitutions }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- emergencyServices (Monthly) Card Example -->
      <a href="{{ route('emergencyServices') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Emergency Services
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $emergencyServices }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- airlineOperators (Monthly) Card Example -->
      <a href="{{ route('airlineOperators') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Airline Operators
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $airlineOperators }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- restaurants (Monthly) Card Example -->
      <a href="{{ route('restaurants') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Restaurants
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $restaurants }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- hotels (Monthly) Card Example -->
      <a href="{{ route('hotels') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Hotels
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $hotels }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- cleaning (Monthly) Card Example -->
      <a href="{{ route('cleaning') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Cleaning and Garbage
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $cleaning }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- tours (Monthly) Card Example -->
      <a href="{{ route('tours') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Tours and Travel
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $tours }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- supermarkets (Monthly) Card Example -->
      <a href="{{ route('supermarkets') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Supermarkets
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $supermarkets }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- garages (Monthly) Card Example -->
      <a href="{{ route('garages') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Garages
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $garages }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- insurance (Monthly) Card Example -->
      <a href="{{ route('insurance') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Insurance
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $insurance }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- clearingAgents (Monthly) Card Example -->
      <a href="{{ route('clearingAgents') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Clearing Agents
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $clearingAgents }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- educationServices (Monthly) Card Example -->
      <a href="{{ route('educationServices') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  Education Services
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $educationServices }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- ngos (Monthly) Card Example -->
      <a href="{{ route('ngos') }}" class="col-xl-2 col-md-6 mb-4" style="text-decoration: none;">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div
                  class="
                    text-xs
                    font-weight-bold
                    text-secondary text-uppercase
                    mb-1
                  "
                >
                  NGOs
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $ngos }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      
    </div>
</div>
@endsection
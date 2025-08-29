@extends('layout.master')
@section('title','Ticket Slot')
@section('content')
    <style>
            a{
                text-decoration: none;
            }
            .table thead {
                background: linear-gradient(45deg, #007acc, #004a8f);
                color: #fff;
            }
            .table-hover tbody tr:hover {
                background-color: rgba(0, 122, 204, 0.08);
                transition: 0.3s;
            }
            .action-btn {
                border: none;
                background: transparent;
                cursor: pointer;
                font-size: 1.2rem;
                margin: 0 5px;
            }
            .action-btn.view { color: #17a2b8; }
            .action-btn.edit { color: #ffc107; }
            .action-btn.delete { color: #dc3545; }
            .action-btn:hover { transform: scale(1.2); }
            .table-title {
                font-weight: 700;
                font-size: 1.6rem;
                color: #004a8f;
                margin-bottom: 15px;
                text-align: center;
            }
        </style>

        {{--alert--}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Done !</strong> {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error !</strong> {{session('danger')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{--    filter--}}
        <form action="#" method="post">
            @csrf
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{route('slot.create')}}" class="btn btn-primary" role="button"><i class="bi bi-plus-lg"></i> Add Ticket Slot</a>
                </div>
                <div>
                    <input type="text"  name="bus_code" class="form-control" placeholder="Bus Code" required>
                </div>
                <div>
                    <input type="number"  name="available_seats" class="form-control" placeholder="Available Seats">
                </div>
                <div>
                    <select name="type"  class="form-control">
                        <option selected disabled>----CHOOSE TYPE----</option>
                        <option  value="AC">AC</option>
                        <option  value="Non-AC">Non-AC</option>
                        <option  value="Sleeper">Sleeper</option>
                    </select>
                </div>
                <div>
                    <select name="status"  class="form-control">
                        <option selected disabled>----CHOOSE STATUS----</option>
                        <option  value="active">Active</option>
                        <option  value="inactive">Inactive</option>
                        <option  value="maintenance">Maintenance</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="form-control btn btn-success"><i class="bi bi-funnel"></i> Filter</button>
                </div>
            </div>
        </form>

        {{-- table--}}
        <table class="table table-hover table-striped align-middle mt-5">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Route</th>
                <th>Schedule</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Status</th>
                <th>Created</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $d)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$d->busRoute->start_location}} to {{$d->busRoute->end_location}}</td>
                  <td>{{Carbon\Carbon::parse($d->schedule)->toDayDateTimeString()}}</td>
                  <td>{{$d->price}} Tk</td>
                  <td>{{$d->discount}} %</td>
                  <td>
                      @if($d->status == 1)
                          <span class="badge bg-success">Active</span>
                      @else
                          <span class="badge bg-danger text-dark">Inactive</span>
                      @endif
                  </td>
                  <td>{{ Carbon\Carbon::parse($d->created_at)->diffForHumans()  }}</td>
                  <td class="text-center">
                      <a href="#" class="text-info me-2" title="View">
                          <i class="bi bi-eye-fill"></i>
                      </a>
                      <a href="{{route('slot.edit',$d->id)}}" class="text-primary me-2" title="Edit">
                          <i class="bi bi-pencil-square"></i>
                      </a>
                      <form action="{{route('slot.destroy',$d->id)}}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link p-0 text-danger" onclick="return confirm('Are you sure to delete?')" title="Delete">
                              <i class="bi bi-trash-fill"></i>
                          </button>
                      </form>
                  </td>
              </tr>
            @empty
                <tr class="text-center text-danger">No Data Found</tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">

        </div>

@endsection

@extends('dashboard.layouts.master',['title'=>'Admin Stark | Contact us'])
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">Show All Message</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="{{route('admin.show-message')}}">Show Message</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.show-message')}}">Messages</a></li>
                            <li class="breadcrumb-item active">Members</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Is User</th>
                                    <th>Message</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->full_name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>
                                            @if($contact->is_user==1)
                                                <label class="badge bg-success">yes</label>
                                              @else
                                                <label class="badge bg-danger">no</label>
                                        @endif
                                        </td>
                                        <td>
                                            @can('message-show')
                                            <a href="#exampleModal{{$contact->id}}" data-bs-toggle="modal" class="btn btn-sm {{ $contact->is_read ? 'btn-secondary' : 'btn-primary' }}">
                                                <i class="fas fa-eye"></i>
                                                Show
                                            </a>
                                            <div class="modal fade" id="exampleModal{{$contact->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Show Message</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                    onclick="location.href='{{ route('admin.read-message', $contact->id) }}'"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{$contact->message}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                                    onclick="location.href='{{ route('admin.read-message', $contact->id) }}'"
                                                            >Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endcan
                                        </td>
                                        <td>{{$contact->created_at}}</td>
                                        <td>
                                            @can('message-delete')
                                            <a href="{{route('admin.delete-message',$contact->id)}}"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to do it?');">
                                                <i class="fa-solid fa-trash"></i>
                                                Delete
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>

                                @empty
                                    <p>No Data</p>
                                @endforelse
                                </tbody>

                            </table>
                            {{ $contacts->links() }}

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        @endsection
    </div>
    @push('js')
        <!-- DataTables -->
        <script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
        <!-- page script -->
        <script>
            $(function () {

                $('#example1').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": false,
                    "info": false,
                    "autoWidth": false,
                });
            });
        </script>
    @endpush
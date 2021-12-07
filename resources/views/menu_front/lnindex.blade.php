 <!--begin: Datatable-->
                                        <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                                            <thead>
                                                <tr>
                                                    <th title="Field #1">No</th>
                                                    <th title="Field #2">Name</th>
                                                    <th title="Field #3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($data as $key => $menu)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
        <td>{{ $menu->menu }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('menus.show',$menu->id_menu) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('menus.edit',$menu->id_menu) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['menus.destroy', $menu->id_menu],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
                                                    <td align="right">3</td>
                                                    <td align="right">3</td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                        </table>
                                        <!--end: Datatable-->
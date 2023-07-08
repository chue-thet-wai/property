<div class="card card-xxl-stretch">
    <div class="table-responsive">
        <table class="table table-bordered" id="kt_table_widget_1">
            <tbody>
                <tr class="text-start bg-primary text-white text-uppercase">
                    @foreach ($headers as $key => $value)
                        @if($value == "actions")
                            <th width="300px">{{ $value }}</th>
                        @else
                            <th class="min-w-125px">{{ $value }}</th>
                        @endif
                    @endforeach
                </tr>
                @foreach ($body as $row)
                    <tr>
                        @foreach ($row as $key => $value)
                            @switch($key)
                                @case('actions')
                                    <?php 
                                        $show_route = $routename .'.show'; 
                                        $edit_route = $routename .'.edit'; 
                                        $delete_route = $routename .'.destroy'; 
                                    ?>
                                    <td>
                                        <a href="{{ route($show_route,$value) }}" class="btn btn-primary">View</a>
                                        <a class="px-3 btn btn-primary"  href="{{ route($edit_route,$value) }}">Edit</a>                                                
                                        {!! Form::open(['method' => 'DELETE','route' => [$delete_route, $value],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger text-white']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    @break
                                @case('action')
                                    <?php 
                                        $edit_route = $routename .'.edit'; 
                                    ?>
                                    <td>
                                        <a class="px-3 btn btn-primary"  href="{{ route($edit_route,$value) }}">Edit</a> 
                                    </td>
                                    @break
                                @case('category')
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $categories[$value] }}</span>
                                    </td>
                                    @break                                    
                                @case('protype')
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $protypes[$value] }}</span>
                                    </td>
                                    @break
                                @case('enquiry_type')
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $enquirytypes[$value] }}</span>
                                    </td>
                                    @break
                                @case('leavestatus')
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $leavestatus[$value] }}</span>
                                    </td>
                                    @break
                                @default
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $value }}</span>
                                    </td>
                            @endswitch
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

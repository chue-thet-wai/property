<div class="card card-xxl-stretch">
    <div class="table-responsive">
        <table class="table table-bordered" id="table_id">
            <thead>
                <tr class="text-start bg-primary text-white text-uppercase">
                    @foreach ($headers as $key => $value)
                        @if($value == "actions")
                            <th width="300px">{{ $value }}</th>
                        @else
                            <th class="min-w-125px">{{ $value }}</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($body as $row)
                    <tr class="">
                        @foreach ($row as $key => $value)
                            @switch($key)
                                @case('actions')
                                    <?php 
                                        $show_route = $routename .'.show'; 
                                        $edit_route = $routename .'.edit'; 
                                        $delete_route = $routename .'.softdelete';
                                    ?>
                                    <td>
                                        <a href="{{ route($show_route,$value) }}" class="btn btn-action-dark px-3">View</a>
                                        <a class="btn btn-action-dark px-3"  href="{{ route($edit_route,$value) }}">Edit</a>
                                        {!! Form::open(['method' => 'POST', 'style' => 'display:inline']) !!}
                                            {!! Form::button('Delete', ['class' => 'btn btn-action-danger text-white px-3', 'onclick' => 'ConfirmDialog("' . route($delete_route) . '","' . $value . '")']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    @break
                                @case('action')
                                    <?php 
                                        $edit_route = $routename .'.edit'; 
                                    ?>
                                    <td class="w-25">
                                        <a class="px-3 btn btn-action-dark"  href="{{ route($edit_route,$value) }}">Edit</a> 
                                    </td>
                                    @break
                                @case('category')
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $categories[$value] }}</span>
                                    </td>
                                    @break 
                                @case('type')
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
                                @case('status')
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $status[$value] }}</span>
                                    </td>
                                    @break
                                @case('rent_status')
                                    <td>
                                        <span class="text-gray-800 fw-boldest">{{ $rent_status[$value] }}</span>
                                    </td>
                                    @break 
                                @case('logo')
                                    <td>
                                        <img class="w-25" src="{{asset('thumbnails/information-logos/'.$value)}}" alt="logo">
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

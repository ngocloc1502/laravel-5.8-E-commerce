@extends ('Admin/index')
@section ('content')
	<section>
		<section>
			<table>
				<tr>
					<td><input type="text" name="name"></td>
					<td>
						<select>
							@foreach ($bands as $row)
								<option value="{{$row->mahang}}">{{$row->tenhang}}</option>
							@endforeach
						</select>
					</td>
				</tr>
			</table>
		</section>
	</section>
@endsection
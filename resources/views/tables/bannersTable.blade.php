<!DOCTYPE html>
<html lang="en">
  @include('tables/tablesHead/bannersTableHead')
  <body>
    @if ($message = Session::get('success'))
    <form>
      <div class="alert alert-success alert-block text-dark alert-dismissible">
        <strong>{{ $message }}</strong>
        <button type="submit" class="btn-close"></button>
      </div>
    </form>
    @endif

    <div class="container mt-5">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Banner Image</th>
            <th>Banner Text</th>
            <th>Edit Banner</th>
            <th>Delete Banner</th>
          </tr>
        </thead>

        @foreach ($data as $key => $data)

        <tbody>
          <tr>
            <th>{{ $key + 1 }}</th>
            <td>{{ $data->image }}</td>
            <td>
              @foreach ($data->texts as $text)
                {!! $text->text !!}
              @endforeach
            </td>            
            <td>
              <a href="edit/{{ $data->id }}"
                ><i
                  class="fas fa-pencil text-warning me-2 ms-1 mb-2 fa-fw fa-2x"
                  role="button"
                ></i
              ></a>
            </td>
            <td>
              <a href="remove/{{ $data->id }}"
                ><i
                  class="fas fa-xmark text-danger me-2 ms-1 mb-2 fa-fw fa-2x"
                  role="button"
                ></i
              ></a>
            </td>
          </tr>
        </tbody>
        @endforeach

        <tfoot>
          <tr>
            <th>Id</th>
            <th>Banner Image</th>
            <th>Banner Text</th>
            <th>Edit Banner</th>
            <th>Delete Banner</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </body>
</html>

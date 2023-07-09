<style>
.th{
    width: 100%;
    border: 1px solid black;
    background-color: green;
    color: white;
}
tr th {
    border: 1px solid black;

}
</style>
<table style="border: 1px solid black">
    <thead>
    <tr>
        <th class="th">Label</th>
        <th class="th">Description</th>
        <th class="th">Active</th>
        <th class="th">Creation Date</th>
    </tr>
    </thead>
    <tbody>
        @foreach($sections as $section)
        <tr>
            <td>{{ $section->Label }}</td>
            <td>{{ $section->Description }}</td>
            <td>{{ $section->Active ? 'active' :'not active' }}</td>
            <td>{{ $section->created_at }}</td>
        </tr>
    @endforeach
</tbody>
</table>
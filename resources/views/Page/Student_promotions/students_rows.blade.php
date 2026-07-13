@foreach($students as $student)

<tr>

    <td>
        <input type="checkbox"
               name="students[]"
               value="{{ $student->id }}"
               class="student_checkbox">
    </td>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $student->Name }}</td>

    <td>{{ $student->academic_number }}</td>

</tr>

@endforeach
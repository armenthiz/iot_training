<body>
    <h3>
        Hello {{ $detail['email'] }}
    </h3>
    <p>
        Somebody request for change password <br />
        if you dont please ignore this email, <br />
        but if you do, please check link below for further instruction.
    </p>
    {!! link_to(route('reminders.edit', ['id' => $detail['id'], 'code' => $detail['code']]), 'Click me') !!}
    <h2>Thanks</h2>
</body>
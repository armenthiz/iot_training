<body>
    <h3>
        Hello {!! $detail['email'] !!}
    </h3>
    <p>
        Somebody request for changes your password.
        <br />
        If you dont, please ignore this email.
        <br />
        But if you do, please click link below for further instruction.
    </p>
    {!! link_to(route('reminders.edit', ['id' => $detail['id'], 'code' => $detail['code']]), 'Click me!') !!}
    <h2>
        Thanks
    </h2>
</body>
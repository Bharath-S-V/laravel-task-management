@extends('layouts.app')

@section('content')
    <div class="container-fluid text-center"
        style="height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="animated-greeting">
            <h1 class="display-4">Welcome to <span class="highlight">Metromindz</span> Technologies</h1>
            <p class="lead">Innovating the Future with Technology</p>
            <a href="/login" class="btn btn-primary">Start</a>
        </div>
    </div>
@endsection

<script>
    // GSAP Animation for advanced effects
    gsap.from('.animated-greeting h1', {
        duration: 1.5,
        opacity: 0,
        y: -50,
        ease: "power2.out"
    });

    gsap.from('.animated-greeting p', {
        duration: 2,
        opacity: 0,
        y: 20,
        delay: 0.5,
        ease: "power2.out"
    });

    gsap.to('.highlight', {
        scale: 1.2,
        repeat: -1,
        yoyo: true,
        ease: "power2.inOut",
        duration: 0.8
    });
</script>

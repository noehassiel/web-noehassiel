<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            background: #d1684e;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        #wrap {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            overflow: hidden;
        }

        #wrap canvas {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 500px;
            height: 500px;
            margin: -250px 0 0 -250px;
            -outline: 1px solid #fff;
        }

        .info {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 12px;
            color: #ccc;
            line-height: 2em;
            text-align: center;
        }
    </style>
</head>

<body class="antialiased">
    <div id="wrap"></div>
    <p class="info">* Mouse or Finger press on the page to finish loading action.</p>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r77/three.min.js"></script>
<script>
    var $body = document.body,
        $wrap = document.getElementById('wrap'),

        areawidth = window.innerWidth,
        areaheight = window.innerHeight,

        canvassize = 500,

        length = 30,
        radius = 5.6,

        rotatevalue = 0.035,
        acceleration = 0,
        animatestep = 0,
        toend = false,

        pi2 = Math.PI * 2,

        group = new THREE.Group(),
        mesh, ringcover, ring,

        camera, scene, renderer;


    camera = new THREE.PerspectiveCamera(65, 1, 1, 10000);
    camera.position.z = 150;

    scene = new THREE.Scene();
    // scene.add(new THREE.AxisHelper(30));
    scene.add(group);

    mesh = new THREE.Mesh(
        new THREE.TubeGeometry(new(THREE.Curve.create(function() {},
            function(percent) {

                var x = length * Math.sin(pi2 * percent),
                    y = radius * Math.cos(pi2 * 3 * percent),
                    z, t;

                t = percent % 0.25 / 0.25;
                t = percent % 0.25 - (2 * (1 - t) * t * -0.0185 + t * t * 0.25);
                if (Math.floor(percent / 0.25) == 0 || Math.floor(percent / 0.25) == 2) {
                    t *= -1;
                }
                z = radius * Math.sin(pi2 * 2 * (percent - t));

                return new THREE.Vector3(x, y, z);

            }
        ))(), 200, 1.1, 2, true),
        new THREE.MeshBasicMaterial({
            color: 0xffffff
            // , wireframe: true
        })
    );
    group.add(mesh);

    ringcover = new THREE.Mesh(new THREE.PlaneGeometry(50, 15, 1), new THREE.MeshBasicMaterial({
        color: 0xd1684e,
        opacity: 0,
        transparent: true
    }));
    ringcover.position.x = length + 1;
    ringcover.rotation.y = Math.PI / 2;
    group.add(ringcover);

    ring = new THREE.Mesh(new THREE.RingGeometry(4.3, 5.55, 32), new THREE.MeshBasicMaterial({
        color: 0xffffff,
        opacity: 0,
        transparent: true
    }));
    ring.position.x = length + 1.1;
    ring.rotation.y = Math.PI / 2;
    group.add(ring);

    // fake shadow
    (function() {
        var plain, i;
        for (i = 0; i < 10; i++) {
            plain = new THREE.Mesh(new THREE.PlaneGeometry(length * 2 + 1, radius * 3, 1), new THREE
                .MeshBasicMaterial({
                    color: 0xd1684e,
                    transparent: true,
                    opacity: 0.13
                }));
            plain.position.z = -2.5 + i * 0.5;
            group.add(plain);
        }
    })();

    renderer = new THREE.WebGLRenderer({
        antialias: true
    });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(canvassize, canvassize);
    renderer.setClearColor('#d1684e');

    $wrap.appendChild(renderer.domElement);

    $body.addEventListener('mousedown', start, false);
    $body.addEventListener('touchstart', start, false);
    $body.addEventListener('mouseup', back, false);
    $body.addEventListener('touchend', back, false);

    animate();


    function start() {
        toend = true;
    }

    function back() {
        toend = false;
    }

    function tilt(percent) {
        group.rotation.y = percent * 0.5;
    }

    function render() {

        var progress;

        animatestep = Math.max(0, Math.min(240, toend ? animatestep + 1 : animatestep - 4));
        acceleration = easing(animatestep, 0, 1, 240);

        if (acceleration > 0.35) {
            progress = (acceleration - 0.35) / 0.65;
            group.rotation.y = -Math.PI / 2 * progress;
            group.position.z = 50 * progress;
            progress = Math.max(0, (acceleration - 0.97) / 0.03);
            mesh.material.opacity = 1 - progress;
            ringcover.material.opacity = ring.material.opacity = progress;
            ring.scale.x = ring.scale.y = 0.9 + 0.1 * progress;
        }

        renderer.render(scene, camera);

    }

    function animate() {
        mesh.rotation.x += rotatevalue + acceleration;
        render();
        requestAnimationFrame(animate);
    }

    function easing(t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    }
</script>

</html>

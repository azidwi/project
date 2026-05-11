<!DOCTYPE html>
<html>
<head>
<title>User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r152/three.min.js"></script>

<style>
@keyframes moveSlow {
    0% { transform: translate(0,0) scale(1); }
    50% { transform: translate(-40px, 30px) scale(1.05); }
    100% { transform: translate(0,0) scale(1); }
}

@keyframes moveReverse {
    0% { transform: translate(0,0); }
    50% { transform: translate(40px,-30px); }
    100% { transform: translate(0,0); }
}
</style>

</head>

<body class="bg-black text-white overflow-x-hidden">
    <audio id="bgmusic" autoplay loop>
    <source src="/music/bg.mp3" type="audio/mpeg">
</audio>

<div id="webgl" class="fixed top-0 left-0 w-full h-full z-0"></div>

<!-- CANVAS -->
<canvas id="bgCanvas" class="fixed top-0 left-0 w-full h-full z-0"></canvas>

<!-- GLOW LAYER -->
<div class="fixed w-[900px] h-[900px]
bg-[radial-gradient(circle,rgba(255,255,255,0.15),transparent_70%)]
blur-[140px] top-[-300px] right-[-200px]
animate-[moveSlow_12s_infinite]"></div>

<div class="fixed w-[800px] h-[800px]
bg-[radial-gradient(circle,rgba(255,255,255,0.05),transparent_70%)]
blur-[120px] bottom-[-300px] left-[-200px]
animate-[moveReverse_14s_infinite]"></div>

<!-- PLANET -->
<div class="fixed w-[1200px] h-[500px]
bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.15),transparent_70%)]
blur-[80px] bottom-[-250px] left-1/2 -translate-x-1/2"></div>

<!-- NOISE -->
<div class="fixed inset-0 opacity-[0.03] pointer-events-none"
style="background-image:url('https://grainy-gradients.vercel.app/noise.svg');"></div>

<!-- NAVBAR -->
<nav class="relative z-10 flex justify-between items-center px-10 py-6">
    <div class="font-bold text-lg">MyApp</div>

    <div class="space-x-6 text-gray-400">
        <a href="/user/home" class="hover:text-white">Home</a>
        <a href="/user/dashboard" class="hover:text-white">Dashboard</a>
        <a href="/user/buku" class="hover:text-white">Buku</a>
        <a href="/user/pensil" class="hover:text-white">Pensil</a>
        <a href="/user/profile" class="hover:text-white">Profile</a>
    </div>

    <a href="{{ route('logout') }}" class="hover:text-white">Logout</a>
</nav>

<!-- CONTENT -->
<div class="relative z-10 px-6">
    @yield('content')
</div>

<!-- SCRIPT (PINDAH KE BAWAH BIAR GAK ERROR) -->
<script>
const canvas = document.getElementById('bgCanvas');
const ctx = canvas.getContext('2d');

let w,h;
function resize(){
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
}
resize();
window.addEventListener('resize', resize);

// mouse smooth
let mouse = {x:w/2,y:h/2};
let target = {x:w/2,y:h/2};

window.addEventListener('mousemove', e=>{
    target.x = e.clientX;
    target.y = e.clientY;
});

// PARTICLE (FLOAT UP)
let particles = [];

for(let i=0;i<100;i++){
    particles.push({
        x: Math.random()*w,
        y: Math.random()*h,
        r: Math.random()*2,
        speed: Math.random()*0.6+0.2
    });
}

function draw(){

    // smooth follow (biar gak patah)
    mouse.x += (target.x - mouse.x)*0.05;
    mouse.y += (target.y - mouse.y)*0.05;

    ctx.clearRect(0,0,w,h);

    // MAIN LIGHT
    let grad = ctx.createRadialGradient(
        mouse.x, mouse.y, 0,
        mouse.x, mouse.y, 600
    );
    grad.addColorStop(0,"rgba(255,255,255,0.08)");
    grad.addColorStop(1,"transparent");

    ctx.fillStyle = grad;
    ctx.fillRect(0,0,w,h);

    // SECOND LIGHT (center glow halus)
    let centerGlow = ctx.createRadialGradient(
        w/2, h/2, 0,
        w/2, h/2, 800
    );
    centerGlow.addColorStop(0,"rgba(255,255,255,0.03)");
    centerGlow.addColorStop(1,"transparent");

    ctx.fillStyle = centerGlow;
    ctx.fillRect(0,0,w,h);

    // PARTICLE FLOAT UP
    particles.forEach(p=>{
        p.y -= p.speed;

        if(p.y < 0){
            p.y = h;
            p.x = Math.random()*w;
        }

        ctx.beginPath();
        ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
        ctx.fillStyle="rgba(255,255,255,0.2)";
        ctx.fill();
    });

    requestAnimationFrame(draw);
}

draw();
</script>

<div id="parallax" class="fixed inset-0 pointer-events-none z-0"></div>

<script>
const parallax = document.getElementById('parallax');

window.addEventListener('mousemove', e=>{
    let x = (e.clientX / window.innerWidth - 0.5) * 30;
    let y = (e.clientY / window.innerHeight - 0.5) * 30;

    parallax.style.transform = `translate(${x}px, ${y}px)`;
});
</script>

<script>
const container = document.getElementById('webgl');

// scene
const scene = new THREE.Scene();

// camera
const camera = new THREE.PerspectiveCamera(
    75,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
);
camera.position.z = 5;

// renderer
const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);
container.appendChild(renderer.domElement);
renderer.domElement.style.mixBlendMode = "screen";

// PARTICLES
const particlesCount = 2000;
const geometry = new THREE.BufferGeometry();

const positions = new Float32Array(particlesCount * 3);

for (let i = 0; i < particlesCount; i++) {
    positions[i * 3] = (Math.random() - 0.5) * 10;
    positions[i * 3 + 1] = (Math.random() - 0.5) * 10;
    positions[i * 3 + 2] = (Math.random() - 0.5) * 10;
}

geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

// material
const material = new THREE.PointsMaterial({
    size: 0.05,
    color: 0xffffff,
    transparent: true,
    opacity: 1,
    blending: THREE.AdditiveBlending,
    depthWrite: false
});

// mesh
const particles = new THREE.Points(geometry, material);
scene.add(particles);

// mouse parallax
let mouseX = 0;
let mouseY = 0;

window.addEventListener('mousemove', (e) => {
    mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
    mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
});

// animate
function animate() {
    requestAnimationFrame(animate);

    particles.rotation.y += 0.002;
particles.rotation.x += 0.001;
particles.material.size = 0.04 + Math.sin(Date.now()*0.002)*0.015;

    // parallax
    camera.position.x += (mouseX - camera.position.x) * 0.02;
    camera.position.y += (-mouseY - camera.position.y) * 0.02;

    renderer.render(scene, camera);
}

animate();

// resize
window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});
</script>

<script>
document.body.addEventListener('click', () => {
    const music = document.getElementById('bgmusic');
    music.volume = 0.15;
    music.play();
}, { once:true });
</script>

</body>
</html>
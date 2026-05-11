<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r152/three.min.js"></script>



</head>

<body class="bg-black text-white overflow-hidden">
    <audio id="bgmusic" loop preload="auto">
    <source src="{{ asset('music/bg.mp3') }}" type="audio/mpeg">
</audio>

<div class="fixed inset-0 z-[1] opacity-[0.03]"
style="background-image:url('https://grainy-gradients.vercel.app/noise.svg')">
</div>

<!-- GLOW MOUSE -->
<div id="glow" class="fixed w-[220px] h-[220px] pointer-events-none
bg-[radial-gradient(circle,rgba(255,255,255,0.15),transparent_70%)]
blur-[50px] z-[1]"></div>

<script>
const glow = document.getElementById('glow');

let gx=0, gy=0, tx=0, ty=0;

window.addEventListener('mousemove', e=>{
tx = e.clientX;
ty = e.clientY;
});

function animateGlow(){
gx += (tx - gx)*0.1;
gy += (ty - gy)*0.1;

glow.style.left = (gx - 110) + "px";
glow.style.top = (gy - 110) + "px";

requestAnimationFrame(animateGlow);
}

animateGlow();  
</script>

<div class="fixed inset-0 z-[-2]"
style="
background:
radial-gradient(circle at 30% 40%, rgba(255,255,255,0.08), transparent 40%),
radial-gradient(circle at 70% 60%, rgba(255,255,255,0.06), transparent 50%),
#000;
">
</div>

<!-- LIGHT BLOOM (INI) -->
<div class="fixed w-[1200px] h-[600px]
bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.15),transparent_70%)]
blur-[100px] bottom-[-250px] left-1/2 -translate-x-1/2 z-[-1]">
</div>

<!-- WEBGL -->
<div id="webgl" class="fixed top-0 left-0 w-full h-full z-0"></div>

<!-- LOGIN CENTER -->
<div class="relative z-10 flex items-center justify-center h-screen">

<div class="relative w-[380px] overflow-hidden rounded-xl">

<!-- GLASS -->
<div class="absolute inset-0 bg-white/10 backdrop-blur-2xl rounded-xl border border-white/10"></div>

<div class="relative z-10 p-6">

<!-- TAB -->
<div class="relative mb-6">

<div class="flex text-center relative z-10">
<button id="loginTab" class="flex-1 py-2">Login</button>
<button id="registerTab" class="flex-1 py-2 text-gray-400">Register</button>
</div>

<!-- GARIS ANIMASI -->
<div id="indicator"
class="absolute bottom-0 left-0 w-1/2 h-[2px] bg-white transition-all duration-300"></div>

</div>

<!-- LOGIN -->
<div id="loginForm">

<form method="POST" action="{{ route('login') }}" class="space-y-4">
@csrf

<input type="email" name="email"
class="w-full p-3 bg-transparent border border-gray-700 rounded-lg"
placeholder="Email">

<input type="password" name="password"
class="w-full p-3 bg-transparent border border-gray-700 rounded-lg"
placeholder="Password">

<button class="w-full bg-white text-black py-3 rounded-lg font-semibold">
Login
</button>

</form>

</div>

<!-- REGISTER -->
<div id="registerForm" class="hidden">

<form method="POST" action="{{ route('register') }}" class="space-y-4">
@csrf

<input type="text" name="name"
class="w-full p-3 bg-transparent border border-gray-700 rounded-lg"
placeholder="Nama">

<input type="email" name="email"
class="w-full p-3 bg-transparent border border-gray-700 rounded-lg"
placeholder="Email">

<input type="password" name="password"
class="w-full p-3 bg-transparent border border-gray-700 rounded-lg"
placeholder="Password">

<button class="w-full bg-white text-black py-3 rounded-lg font-semibold">
Register
</button>

</form>

</div>

</div>
</div>
</div>

<!-- WEBGL SCRIPT -->
<script>
const scene = new THREE.Scene();
scene.fog = new THREE.Fog(0x000000, 2, 10);

const camera = new THREE.PerspectiveCamera(
75, window.innerWidth/window.innerHeight, 0.1, 1000
);
camera.position.z = 5;

const renderer = new THREE.WebGLRenderer({ alpha:true });
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('webgl').appendChild(renderer.domElement);

// PARTICLES
const count = 2000;
const geometry = new THREE.BufferGeometry();
const positions = new Float32Array(count*3);

for(let i=0;i<count;i++){
positions[i*3]=(Math.random()-0.5)*10;
positions[i*3+1]=(Math.random()-0.5)*10;
positions[i*3+2]=(Math.random()-0.5)*10;
}

geometry.setAttribute('position', new THREE.BufferAttribute(positions,3));

const material = new THREE.PointsMaterial({
size:0.1,
color:0xffffff,
transparent:true,
opacity:0.8,
blending:THREE.AdditiveBlending,
depthWrite:false
});

const mesh = new THREE.Points(geometry, material);
scene.add(mesh);

// MOUSE
let mx=0,my=0;
window.addEventListener('mousemove',e=>{
mx=(e.clientX/window.innerWidth-0.3)*2;
my=(e.clientY/window.innerHeight-0.3)*2;
});

// ANIMATE (INI YANG BENER)
function animate(){
requestAnimationFrame(animate);

mesh.rotation.y += 0.002;
mesh.rotation.x += 0.001;

material.size = 0.06 + Math.sin(Date.now()*0.002)*0.02;

camera.position.x += (mx-camera.position.x)*0.05;
camera.position.y += (-my-camera.position.y)*0.05;

renderer.render(scene,camera);
}

animate(); // <-- WAJIB DI LUAR

// RESIZE
window.addEventListener('resize',()=>{
camera.aspect=window.innerWidth/window.innerHeight;
camera.updateProjectionMatrix();
renderer.setSize(window.innerWidth,window.innerHeight);
});
</script>

<script>
const loginTab = document.getElementById('loginTab');
const registerTab = document.getElementById('registerTab');

const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

const indicator = document.getElementById('indicator');

loginTab.onclick = () => {
loginForm.classList.remove('hidden');
registerForm.classList.add('hidden');

indicator.style.left = "0%";

loginTab.classList.remove('text-gray-400');
registerTab.classList.add('text-gray-400');
};

registerTab.onclick = () => {
loginForm.classList.add('hidden');
registerForm.classList.remove('hidden');

indicator.style.left = "50%";

registerTab.classList.remove('text-gray-400');
loginTab.classList.add('text-gray-400');
};
</script>

<script>
const music = document.getElementById('bgmusic');

music.volume = 0.4;

function startMusic() {

music.play().then(() => {
console.log("music started");
}).catch((err) => {
console.log(err);
});

document.removeEventListener('mousemove', startMusic);
document.removeEventListener('click', startMusic);
document.removeEventListener('keydown', startMusic);

}

document.addEventListener('mousemove', startMusic);
document.addEventListener('click', startMusic);
document.addEventListener('keydown', startMusic);
</script>

</body>
</html>
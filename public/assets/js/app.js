const siteHeader = document.querySelector("[data-site-header]");
const navToggle = document.querySelector("[data-nav-toggle]");
const mobileNav = document.querySelector("[data-mobile-nav]");
const backToTopButton = document.querySelector("[data-back-to-top]");

if (navToggle && mobileNav) {
    navToggle.addEventListener("click", () => {
        const willOpen = !mobileNav.classList.contains("is-open");
        setMobileNavState(willOpen);
    });

    mobileNav.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", () => setMobileNavState(false));
    });

    document.addEventListener("click", (event) => {
        if (!siteHeader || !mobileNav.classList.contains("is-open")) {
            return;
        }

        if (!siteHeader.contains(event.target)) {
            setMobileNavState(false);
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            setMobileNavState(false);
        }
    });
}

initStickyHeaderState();
initBackToTop();
initPageTransitions();

function setMobileNavState(isOpen) {
    if (!navToggle || !mobileNav) {
        return;
    }

    mobileNav.classList.toggle("is-open", isOpen);
    navToggle.setAttribute("aria-expanded", String(isOpen));
    navToggle.textContent = isOpen ? "CLOSE" : "MENU";
    siteHeader?.classList.toggle("is-mobile-open", isOpen);
}

function initStickyHeaderState() {
    if (!siteHeader) {
        return;
    }

    let ticking = false;

    function updateHeaderState() {
        siteHeader.classList.toggle("is-scrolled", window.scrollY > 16);
        ticking = false;
    }

    updateHeaderState();

    window.addEventListener(
        "scroll",
        () => {
            if (ticking) {
                return;
            }

            ticking = true;
            requestAnimationFrame(updateHeaderState);
        },
        { passive: true },
    );
}

function initBackToTop() {
    if (!backToTopButton) {
        return;
    }

    let ticking = false;

    function updateBackToTopState() {
        backToTopButton.classList.toggle("is-visible", window.scrollY > 520);
        ticking = false;
    }

    updateBackToTopState();

    window.addEventListener(
        "scroll",
        () => {
            if (ticking) {
                return;
            }

            ticking = true;
            requestAnimationFrame(updateBackToTopState);
        },
        { passive: true },
    );

    backToTopButton.addEventListener("click", () => {
        setMobileNavState(false);

        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
}


function initPageTransitions() {
    if (document.querySelector(".page-transition-overlay")) {
        return;
    }

    const overlay = document.createElement("div");
    overlay.className = "page-transition-overlay";
    overlay.setAttribute("aria-hidden", "true");
    overlay.innerHTML = `
        <div class="page-transition-card">
            <span class="page-transition-kicker">CRYPTO LAB</span>
            <span class="page-transition-mark" aria-hidden="true">
                <i></i>
                <i></i>
                <i></i>
            </span>
            <strong data-transition-title>READY</strong>
            <small data-transition-subtitle>PREPARING INTERFACE</small>
            <span class="page-transition-progress" aria-hidden="true"><i></i></span>
        </div>
    `;
    document.body.appendChild(overlay);

    const title = overlay.querySelector("[data-transition-title]");
    const subtitle = overlay.querySelector("[data-transition-subtitle]");

    document.documentElement.classList.add("page-transition-ready");

    window.setTimeout(() => {
        document.documentElement.classList.add("is-page-loaded");
    }, 120);

    window.addEventListener("pageshow", () => {
        document.documentElement.classList.remove("is-page-leaving");
        document.documentElement.classList.add("is-page-loaded");

        if (title) {
            title.textContent = "READY";
        }

        if (subtitle) {
            subtitle.textContent = "INTERFACE LOADED";
        }
    });

    document.addEventListener("click", (event) => {
        const link = event.target.closest("a");

        if (!link || shouldSkipPageTransition(event, link)) {
            return;
        }

        event.preventDefault();
        setMobileNavState(false);

        if (document.documentElement.classList.contains("is-page-leaving")) {
            return;
        }

        const nextLabel = getTransitionLabel(link);

        if (title) {
            title.textContent = nextLabel;
        }

        if (subtitle) {
            subtitle.textContent = "LOADING MODULE";
        }

        document.documentElement.classList.add("is-page-leaving");

        window.setTimeout(() => {
            window.location.href = link.href;
        }, 520);
    });
}

function getTransitionLabel(link) {
    const text = link.textContent.replace(/\s+/g, " ").trim();

    if (text) {
        return text.toUpperCase();
    }

    try {
        const url = new URL(link.href, window.location.href);
        const path = url.pathname.replace(/^\/+|\/+$/g, "");
        return path ? path.replaceAll("-", " ").toUpperCase() : "HOME";
    } catch (error) {
        return "LOADING";
    }
}

function shouldSkipPageTransition(event, link) {
    if (
        event.defaultPrevented ||
        event.metaKey ||
        event.ctrlKey ||
        event.shiftKey ||
        event.altKey ||
        link.target === "_blank" ||
        link.hasAttribute("download")
    ) {
        return true;
    }

    const href = link.getAttribute("href") || "";

    if (
        href === "" ||
        href.startsWith("#") ||
        href.startsWith("mailto:") ||
        href.startsWith("tel:") ||
        href.startsWith("javascript:")
    ) {
        return true;
    }

    const nextUrl = new URL(link.href, window.location.href);

    if (nextUrl.origin !== window.location.origin) {
        return true;
    }

    return (
        nextUrl.pathname === window.location.pathname &&
        nextUrl.search === window.location.search &&
        nextUrl.hash !== ""
    );
}

const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
).matches;

if (!prefersReducedMotion) {
    initDashboardCipherRain();
    initDotDnaCyberLayer();
    initCursorGlow();
    initCryptoNetworkCore();
    initRevealAnimation();
    initCryptoSidePanels();
    initAmbientHackingLayer();
    initCyberCards();
} else {
    document.documentElement.classList.add("reduced-motion");
}

function initDashboardCipherRain() {
    const cyberPage = document.querySelector(
        ".dashboard-hero, .algorithm-hero",
    );

    if (!cyberPage || document.querySelector(".dashboard-cipher-canvas")) {
        return;
    }

    const canvas = document.createElement("canvas");
    canvas.className = "dashboard-cipher-canvas";
    canvas.setAttribute("aria-hidden", "true");
    document.body.prepend(canvas);

    const context = canvas.getContext("2d");
    const characterSet =
        "01 HASH RSA DES GOST KEY BLOCK CIPHER TEXT ENCRYPT DECRYPT XOR SBOX ROUND FEISTEL PRIVATE PUBLIC PLAINTEXT CIPHERTEXT";
    const characters = characterSet.split("");
    const fontSize = 14;
    const speed = 42;

    let width = 0;
    let height = 0;
    let columns = 0;
    let drops = [];
    let lastFrame = 0;

    function resizeCanvas() {
        const ratio = window.devicePixelRatio || 1;

        width = window.innerWidth;
        height = window.innerHeight;
        columns = Math.floor(width / fontSize);

        canvas.width = width * ratio;
        canvas.height = height * ratio;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;

        context.setTransform(ratio, 0, 0, ratio, 0, 0);
        context.font = `${fontSize}px "JetBrains Mono", "IBM Plex Mono", "SF Mono", Consolas, monospace`;

        drops = Array.from({ length: columns }, () =>
            Math.floor(Math.random() * -height),
        );
    }

    function draw(timestamp) {
        if (timestamp - lastFrame < speed) {
            requestAnimationFrame(draw);
            return;
        }

        lastFrame = timestamp;

        context.fillStyle = "rgba(0, 0, 0, 0.13)";
        context.fillRect(0, 0, width, height);

        drops.forEach((drop, index) => {
            const text =
                characters[Math.floor(Math.random() * characters.length)];
            const x = index * fontSize;
            const y = drop * fontSize;

            context.fillStyle =
                Math.random() > 0.86
                    ? "rgba(124, 255, 178, 0.2)"
                    : "rgba(255, 255, 255, 0.1)";

            context.fillText(text, x, y);

            if (y > height && Math.random() > 0.974) {
                drops[index] = 0;
            } else {
                drops[index] = drop + 1;
            }
        });

        requestAnimationFrame(draw);
    }

    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);
    requestAnimationFrame(draw);
}

function initDotDnaCyberLayer() {
    const cyberPage = document.querySelector(
        ".dashboard-hero, .algorithm-hero",
    );

    if (!cyberPage || document.querySelector(".dotdna-canvas")) {
        return;
    }

    const canvas = document.createElement("canvas");
    canvas.className = "dotdna-canvas";
    canvas.setAttribute("aria-hidden", "true");
    document.body.prepend(canvas);

    const context = canvas.getContext("2d");

    let width = 0;
    let height = 0;
    let nodes = [];
    let sparkles = [];
    let time = 0;

    function resizeCanvas() {
        const ratio = window.devicePixelRatio || 1;

        width = window.innerWidth;
        height = window.innerHeight;

        canvas.width = width * ratio;
        canvas.height = height * ratio;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;

        context.setTransform(ratio, 0, 0, ratio, 0, 0);

        nodes = createCenterNetworkNodes(width, height);
        sparkles = createRandomSparkles(width, height);
    }

    function drawFrame() {
        time += 0.012;

        context.clearRect(0, 0, width, height);

        drawSoftGrid(context, width, height, time);
        drawCenterNetworkLines(context, nodes);
        drawCenterNetworkNodes(context, nodes, time);
        drawRandomSparkles(context, sparkles, width, height, time);

        requestAnimationFrame(drawFrame);
    }

    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);
    requestAnimationFrame(drawFrame);
}

function createCenterNetworkNodes(width, height) {
    const generatedNodes = [];
    const totalNodes = width > 1400 ? 72 : 48;

    for (let index = 0; index < totalNodes; index += 1) {
        const x = randomBetween(width * 0.1, width * 0.9);
        const y = randomBetween(height * 0.04, height * 0.96);

        generatedNodes.push({
            x,
            y,
            baseX: x,
            baseY: y,
            radius: randomBetween(1.1, 2.4),
            phase: randomBetween(0, Math.PI * 2),
            speed: randomBetween(0.2, 0.7),
        });
    }

    return generatedNodes;
}

function createRandomSparkles(width, height) {
    const generatedSparkles = [];
    const totalSparkles = width > 1400 ? 150 : 104;

    for (let index = 0; index < totalSparkles; index += 1) {
        generatedSparkles.push(createSparkle(width, height));
    }

    return generatedSparkles;
}

function createSparkle(width, height) {
    const angle = randomBetween(0, Math.PI * 2);
    const velocity = randomBetween(0.42, 1.5);

    return {
        x: randomBetween(width * 0.08, width * 0.92),
        y: randomBetween(height * 0.04, height * 0.96),
        vx: Math.cos(angle) * velocity,
        vy: Math.sin(angle) * velocity,
        size: randomBetween(0.9, 2.6),
        tail: randomBetween(34, 84),
        phase: randomBetween(0, Math.PI * 2),
        alpha: randomBetween(0.24, 0.66),
        life: randomBetween(260, 620),
        age: 0,
    };
}

function drawSoftGrid(context, width, height, time) {
    context.save();
    context.globalCompositeOperation = "lighter";

    const gridSize = 96;
    const offset = (time * 20) % gridSize;

    context.beginPath();

    for (let x = -gridSize + offset; x < width + gridSize; x += gridSize) {
        context.moveTo(x, 0);
        context.lineTo(x, height);
    }

    for (let y = -gridSize + offset; y < height + gridSize; y += gridSize) {
        context.moveTo(0, y);
        context.lineTo(width, y);
    }

    context.strokeStyle = "rgba(124, 255, 178, 0.03)";
    context.lineWidth = 1;
    context.stroke();

    context.restore();
}

function drawCenterNetworkLines(context, nodes) {
    context.save();
    context.globalCompositeOperation = "lighter";

    for (let i = 0; i < nodes.length; i += 1) {
        for (let j = i + 1; j < nodes.length; j += 1) {
            const firstNode = nodes[i];
            const secondNode = nodes[j];
            const distance = getDistance(firstNode, secondNode);

            if (distance < 150) {
                const alpha = (1 - distance / 150) * 0.08;

                context.beginPath();
                context.moveTo(firstNode.x, firstNode.y);
                context.lineTo(secondNode.x, secondNode.y);
                context.strokeStyle = `rgba(124, 255, 178, ${alpha})`;
                context.lineWidth = 1;
                context.stroke();
            }
        }
    }

    context.restore();
}

function drawCenterNetworkNodes(context, nodes, time) {
    nodes.forEach((node) => {
        node.x = node.baseX + Math.sin(time * node.speed + node.phase) * 12;
        node.y = node.baseY + Math.cos(time * node.speed + node.phase) * 18;

        drawGlowPoint(context, node.x, node.y, node.radius, 0.23);
    });
}

function drawRandomSparkles(context, sparkles, width, height, time) {
    context.save();
    context.globalCompositeOperation = "lighter";

    sparkles.forEach((sparkle, index) => {
        sparkle.x += sparkle.vx;
        sparkle.y += sparkle.vy;
        sparkle.age += 1;

        const outOfBounds =
            sparkle.x < -120 ||
            sparkle.x > width + 120 ||
            sparkle.y < -120 ||
            sparkle.y > height + 120;
        const expired = sparkle.age > sparkle.life;

        if (outOfBounds || expired) {
            sparkles[index] = createSparkle(width, height);
            return;
        }

        const pulse = (Math.sin(time * 5.8 + sparkle.phase) + 1) / 2;
        const alpha = sparkle.alpha * (0.52 + pulse * 0.48);

        const magnitude =
            Math.sqrt(sparkle.vx * sparkle.vx + sparkle.vy * sparkle.vy) || 1;
        const tailX = sparkle.x - (sparkle.vx / magnitude) * sparkle.tail;
        const tailY = sparkle.y - (sparkle.vy / magnitude) * sparkle.tail;

        const gradient = context.createLinearGradient(
            tailX,
            tailY,
            sparkle.x,
            sparkle.y,
        );
        gradient.addColorStop(0, "rgba(124, 255, 178, 0)");
        gradient.addColorStop(0.56, `rgba(124, 255, 178, ${alpha * 0.22})`);
        gradient.addColorStop(1, `rgba(232, 255, 240, ${alpha})`);

        context.beginPath();
        context.moveTo(tailX, tailY);
        context.lineTo(sparkle.x, sparkle.y);
        context.strokeStyle = gradient;
        context.lineWidth = sparkle.size;
        context.stroke();

        context.beginPath();
        context.arc(
            sparkle.x,
            sparkle.y,
            sparkle.size + pulse * 1.5,
            0,
            Math.PI * 2,
        );
        context.fillStyle = `rgba(232, 255, 240, ${alpha})`;
        context.fill();

        context.beginPath();
        context.arc(
            sparkle.x,
            sparkle.y,
            (sparkle.size + 1.4) * 6,
            0,
            Math.PI * 2,
        );
        context.fillStyle = `rgba(124, 255, 178, ${alpha * 0.1})`;
        context.fill();
    });

    context.restore();
}

function drawGlowPoint(context, x, y, radius, alpha) {
    const gradient = context.createRadialGradient(x, y, 0, x, y, radius * 8);

    gradient.addColorStop(0, `rgba(124, 255, 178, ${alpha})`);
    gradient.addColorStop(0.4, `rgba(124, 255, 178, ${alpha * 0.24})`);
    gradient.addColorStop(1, "rgba(124, 255, 178, 0)");

    context.beginPath();
    context.arc(x, y, radius * 8, 0, Math.PI * 2);
    context.fillStyle = gradient;
    context.fill();

    context.beginPath();
    context.arc(x, y, radius, 0, Math.PI * 2);
    context.fillStyle = `rgba(232, 255, 240, ${Math.min(alpha + 0.14, 1)})`;
    context.fill();
}

function initCursorGlow() {
    if (document.querySelector(".cursor-glow")) {
        return;
    }

    const cursorGlow = document.createElement("div");
    cursorGlow.className = "cursor-glow";
    cursorGlow.setAttribute("aria-hidden", "true");
    document.body.appendChild(cursorGlow);

    let targetX = window.innerWidth / 2;
    let targetY = window.innerHeight / 2;
    let currentX = targetX;
    let currentY = targetY;
    let isActive = false;

    window.addEventListener("mousemove", (event) => {
        targetX = event.clientX;
        targetY = event.clientY;

        if (!isActive) {
            cursorGlow.classList.add("is-active");
            isActive = true;
        }
    });

    window.addEventListener("mouseleave", () => {
        cursorGlow.classList.remove("is-active");
        isActive = false;
    });

    function animateCursorGlow() {
        currentX += (targetX - currentX) * 0.16;
        currentY += (targetY - currentY) * 0.16;

        cursorGlow.style.transform = `translate3d(${currentX}px, ${currentY}px, 0) translate(-50%, -50%)`;

        requestAnimationFrame(animateCursorGlow);
    }

    requestAnimationFrame(animateCursorGlow);
}

function getDistance(firstNode, secondNode) {
    const dx = firstNode.x - secondNode.x;
    const dy = firstNode.y - secondNode.y;

    return Math.sqrt(dx * dx + dy * dy);
}

function randomBetween(min, max) {
    return Math.random() * (max - min) + min;
}

function initCryptoNetworkCore() {
    const hero = document.querySelector(".dashboard-hero, .algorithm-hero");

    if (!hero || document.querySelector(".crypto-network-core")) {
        return;
    }

    const core = document.createElement("div");
    core.className = "crypto-network-core";
    core.setAttribute("aria-hidden", "true");

    const ringOuter = document.createElement("div");
    ringOuter.className = "crypto-core-ring crypto-core-ring--outer";

    const ringMiddle = document.createElement("div");
    ringMiddle.className = "crypto-core-ring crypto-core-ring--middle";

    const ringInner = document.createElement("div");
    ringInner.className = "crypto-core-ring crypto-core-ring--inner";

    const center = document.createElement("div");
    center.className = "crypto-core-center";
    center.textContent = "KEY";

    const orbitOne = createOrbit(
        "crypto-core-orbit crypto-core-orbit--one",
        "RSA",
    );
    const orbitTwo = createOrbit(
        "crypto-core-orbit crypto-core-orbit--two",
        "HASH",
    );
    const orbitThree = createOrbit(
        "crypto-core-orbit crypto-core-orbit--three",
        "DES",
    );
    const orbitFour = createOrbit(
        "crypto-core-orbit crypto-core-orbit--four",
        "GOST",
    );

    const nodeLayer = document.createElement("div");
    nodeLayer.className = "crypto-core-node-layer";

    for (let index = 1; index <= 18; index += 1) {
        const node = document.createElement("span");
        node.className = `crypto-core-node crypto-core-node--${index}`;
        nodeLayer.appendChild(node);
    }

    core.appendChild(ringOuter);
    core.appendChild(ringMiddle);
    core.appendChild(ringInner);
    core.appendChild(center);
    core.appendChild(orbitOne);
    core.appendChild(orbitTwo);
    core.appendChild(orbitThree);
    core.appendChild(orbitFour);
    core.appendChild(nodeLayer);

    hero.prepend(core);
}

function createOrbit(className, label) {
    const orbit = document.createElement("div");
    orbit.className = className;

    const token = document.createElement("span");
    token.textContent = label;

    orbit.appendChild(token);

    return orbit;
}

function initTextScramble() {
    return;
}

function initHackTextTransitions() {
    return;
}

function initRevealAnimation() {
    const revealSelectors = [
        ".dashboard-hero-content > .caption",
        ".dashboard-hero-content > h1",
        ".dashboard-hero-content > .dashboard-hero-text",
        ".dashboard-hero .hero-actions",
        ".dashboard-meta-item",
        ".dashboard-section .section-heading",
        ".dashboard-section .text-block > p",
        ".principle-item",
        ".reason-item",
        ".objective-item",
        ".dashboard-module-card",
        ".learning-row",
        ".taxonomy-row",
        ".process-row",
        ".data-row",
        ".stat-cell",
        ".class-summary div",
        ".scope-list div",
        ".dashboard-cta .caption",
        ".dashboard-cta h2",
        ".dashboard-cta p",
        ".dashboard-cta .hero-actions",
        ".algorithm-hero-content > .caption",
        ".algorithm-hero-content > h1",
        ".algorithm-hero-content > .algorithm-hero-text",
        ".algorithm-hero .hero-actions",
        ".algorithm-meta-item",
        ".algorithm-section .section-heading",
        ".algorithm-section .text-block > p",
        ".hash-warning",
        ".concept-card",
        ".formula-card",
        ".application-card",
        ".game-card",
        ".hash-step-card",
        ".hash-flow-item",
        ".hash-form-panel",
        ".hash-output-panel",
        ".hash-game-panel",
        ".game-stat",
        ".game-candidate-card",
        ".hash-compare-card",
        ".algorithm-card",
        ".algorithm-step-card",
        ".algorithm-flow-item",
        ".algorithm-form-panel",
        ".algorithm-output-panel",
        ".algorithm-game-panel",
        ".rsa-form-panel",
        ".rsa-compare-pair > div",
        ".rsa-key-pair > div"
    ];

    const elements = Array.from(document.querySelectorAll(revealSelectors.join(",")))
        .filter((element) => !element.closest("table"))
        .filter((element) => !element.closest(".comparison-table, .member-table, .glossary-table"));

    if (!elements.length) {
        return;
    }

    const sectionGroups = new Map();

    elements.forEach((element) => {
        if (element.dataset.revealReady === "true") {
            return;
        }

        const section = element.closest(
            ".dashboard-hero, .dashboard-section, .dashboard-cta, .algorithm-hero, .algorithm-section, .site-footer",
        ) || document.body;

        if (!sectionGroups.has(section)) {
            sectionGroups.set(section, []);
        }

        sectionGroups.get(section).push(element);
    });

    sectionGroups.forEach((groupElements) => {
        groupElements.forEach((element, index) => {
            element.dataset.revealReady = "true";
            element.classList.add("reveal-ready");
            element.style.setProperty("--reveal-delay", `${Math.min(index * 86, 620)}ms`);
        });
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target);
            });
        },
        {
            threshold: 0.1,
            rootMargin: "0px 0px -64px 0px",
        },
    );

    elements.forEach((element) => observer.observe(element));
}
function initCryptoSidePanels() {
    if (document.querySelector(".crypto-side-panel")) {
        return;
    }

    const tokens = [
        "0101",
        "1010",
        "HASH",
        "RSA",
        "DES",
        "GOST",
        "KEY",
        "BLOCK",
        "ROUND",
        "PHI",
        "MOD",
        "XOR",
        "SBOX",
        "FEISTEL",
        "PUBLIC",
        "PRIVATE",
        "DIGEST",
        "CIPHER",
        "ENCRYPT",
        "DECRYPT",
        "PLAINTEXT",
        "CIPHERTEXT",
    ];

    const leftPanel = createSidePanel("left", tokens);
    const rightPanel = createSidePanel("right", tokens);

    document.body.appendChild(leftPanel);
    document.body.appendChild(rightPanel);

    window.setInterval(() => {
        document.querySelectorAll(".crypto-side-panel span").forEach((item) => {
            if (Math.random() > 0.62) {
                item.textContent =
                    tokens[Math.floor(Math.random() * tokens.length)];
            }

            if (Math.random() > 0.88) {
                item.classList.add("is-hot");
                window.setTimeout(() => item.classList.remove("is-hot"), 240);
            }
        });
    }, 520);
}

function createSidePanel(position, tokens) {
    const panel = document.createElement("aside");
    panel.className = `crypto-side-panel crypto-side-panel--${position}`;
    panel.setAttribute("aria-hidden", "true");

    const columnCount = 5;
    const rowCount = 42;

    for (let columnIndex = 0; columnIndex < columnCount; columnIndex += 1) {
        const column = document.createElement("div");
        column.className = "crypto-side-column";
        column.style.animationDelay = `${columnIndex * -1.8}s`;

        for (let rowIndex = 0; rowIndex < rowCount; rowIndex += 1) {
            const token = document.createElement("span");
            token.textContent =
                tokens[Math.floor(Math.random() * tokens.length)];
            column.appendChild(token);
        }

        panel.appendChild(column);
    }

    return panel;
}

function initAmbientHackingLayer() {
    if (document.querySelector(".crypto-ambient-layer")) {
        return;
    }

    const layer = document.createElement("div");
    layer.className = "crypto-ambient-layer";
    layer.setAttribute("aria-hidden", "true");

    const scan = document.createElement("div");
    scan.className = "crypto-ambient-scan";

    const pulseLeft = document.createElement("div");
    pulseLeft.className = "crypto-ambient-pulse crypto-ambient-pulse--left";

    const pulseRight = document.createElement("div");
    pulseRight.className = "crypto-ambient-pulse crypto-ambient-pulse--right";

    const netLeft = document.createElement("div");
    netLeft.className = "crypto-ambient-network crypto-ambient-network--left";

    const netRight = document.createElement("div");
    netRight.className = "crypto-ambient-network crypto-ambient-network--right";

    layer.appendChild(scan);
    layer.appendChild(pulseLeft);
    layer.appendChild(pulseRight);
    layer.appendChild(netLeft);
    layer.appendChild(netRight);

    document.body.appendChild(layer);
}

function initHoverScramble() {
    return;
}

function initCyberCards() {
    const cards = Array.from(
        document.querySelectorAll(
            [
                ".dashboard-module-card",
                ".principle-item",
                ".reason-item",
                ".objective-item",
                ".stat-cell",
                ".class-summary div",
                ".dashboard-meta-item",
                ".algorithm-meta-item",
                ".concept-card",
                ".formula-card",
                ".application-card",
                ".game-card",
                ".hash-step-card",
                ".hash-flow-item",
                ".hash-form-panel",
                ".hash-output-panel",
                ".hash-game-panel",
                ".game-stat",
                ".game-candidate-card",
                ".hash-compare-card",
                ".algorithm-card",
                ".algorithm-step-card",
                ".algorithm-flow-item",
                ".algorithm-form-panel",
                ".algorithm-output-panel",
                ".algorithm-game-panel",
                ".rsa-form-panel",
                ".rsa-compare-pair > div",
                ".rsa-key-pair > div",
            ].join(","),
        ),
    );

    cards.forEach((card) => {
        if (card.dataset.cyberCardReady === "true") {
            return;
        }

        card.dataset.cyberCardReady = "true";
        card.classList.add("cyber-motion-card");

        const state = {
            targetTiltX: 0,
            targetTiltY: 0,
            currentTiltX: 0,
            currentTiltY: 0,
            targetPointerX: 50,
            targetPointerY: 50,
            currentPointerX: 50,
            currentPointerY: 50,
            isActive: false,
            frame: null,
        };

        function requestCardFrame() {
            if (state.frame !== null) {
                return;
            }

            state.frame = requestAnimationFrame(updateCardFrame);
        }

        function updateCardFrame() {
            state.frame = null;

            state.currentTiltX +=
                (state.targetTiltX - state.currentTiltX) * 0.16;
            state.currentTiltY +=
                (state.targetTiltY - state.currentTiltY) * 0.16;
            state.currentPointerX +=
                (state.targetPointerX - state.currentPointerX) * 0.18;
            state.currentPointerY +=
                (state.targetPointerY - state.currentPointerY) * 0.18;

            card.style.setProperty(
                "--tilt-x",
                `${state.currentTiltX.toFixed(3)}deg`,
            );
            card.style.setProperty(
                "--tilt-y",
                `${state.currentTiltY.toFixed(3)}deg`,
            );
            card.style.setProperty(
                "--pointer-x",
                `${state.currentPointerX.toFixed(2)}%`,
            );
            card.style.setProperty(
                "--pointer-y",
                `${state.currentPointerY.toFixed(2)}%`,
            );

            const stillMoving =
                Math.abs(state.targetTiltX - state.currentTiltX) > 0.015 ||
                Math.abs(state.targetTiltY - state.currentTiltY) > 0.015 ||
                Math.abs(state.targetPointerX - state.currentPointerX) > 0.05 ||
                Math.abs(state.targetPointerY - state.currentPointerY) > 0.05;

            if (state.isActive || stillMoving) {
                requestCardFrame();
            }
        }

        card.addEventListener("pointerenter", () => {
            state.isActive = true;
            card.classList.add("is-card-active");
            requestCardFrame();
        });

        card.addEventListener("pointermove", (event) => {
            const rect = card.getBoundingClientRect();
            const pointerX = event.clientX - rect.left;
            const pointerY = event.clientY - rect.top;

            const percentX = Math.max(0, Math.min(1, pointerX / rect.width));
            const percentY = Math.max(0, Math.min(1, pointerY / rect.height));

            state.targetTiltX = (0.5 - percentY) * 7;
            state.targetTiltY = (percentX - 0.5) * 7;
            state.targetPointerX = percentX * 100;
            state.targetPointerY = percentY * 100;

            requestCardFrame();
        });

        card.addEventListener("pointerleave", () => {
            state.isActive = false;
            state.targetTiltX = 0;
            state.targetTiltY = 0;
            state.targetPointerX = 50;
            state.targetPointerY = 50;
            card.classList.remove("is-card-active");
            requestCardFrame();
        });
    });
}

function scrambleElement(element, options = {}) {
    if (element.dataset.scrambling === "true") {
        return;
    }

    const storedText = element.dataset.originalText;
    const currentText = element.textContent.replace(/\s+/g, " ").trim();
    const finalText = storedText || currentText;

    if (!finalText) {
        return;
    }

    if (!storedText) {
        element.dataset.originalText = finalText;
        element.setAttribute("aria-label", finalText);
    }

    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#%&{}[]<>/\\|+=-*";
    const duration = options.duration || 700;
    const delay = options.delay || 0;
    const intensity = options.intensity || 0.2;

    element.dataset.scrambling = "true";

    window.setTimeout(() => {
        const startTime = performance.now();

        function animate(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            const output = finalText
                .split("")
                .map((letter, index) => {
                    if (letter === " ") {
                        return " ";
                    }

                    const letterProgress = index / finalText.length;

                    if (progress > letterProgress + intensity) {
                        return letter;
                    }

                    return characters[
                        Math.floor(Math.random() * characters.length)
                    ];
                })
                .join("");

            element.textContent = output;

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                element.textContent = finalText;
                element.dataset.scrambling = "false";
            }
        }

        requestAnimationFrame(animate);
    }, delay);
}


window.initCyberCards = initCyberCards;

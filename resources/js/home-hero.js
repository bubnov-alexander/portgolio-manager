const canvas = document.getElementById('neural-bg');

if (canvas instanceof HTMLCanvasElement) {
    const context = canvas.getContext('2d');

    if (context) {
        const pointer = { x: 0, y: 0 };
        let nodes = [];
        let width = 0;
        let height = 0;
        let rafId = null;

        const baseSpacing = 120;

        function resizeCanvas() {
            width = window.innerWidth;
            height = window.innerHeight;

            const ratio = window.devicePixelRatio || 1;
            canvas.width = Math.floor(width * ratio);
            canvas.height = Math.floor(height * ratio);
            canvas.style.width = `${width}px`;
            canvas.style.height = `${height}px`;
            context.setTransform(ratio, 0, 0, ratio, 0, 0);

            const columns = Math.ceil(width / baseSpacing) + 2;
            const rows = Math.ceil(height / baseSpacing) + 2;

            nodes = [];
            for (let y = 0; y < rows; y += 1) {
                for (let x = 0; x < columns; x += 1) {
                    const jitter = 20;
                    nodes.push({
                        baseX: x * baseSpacing + (Math.random() * jitter - jitter / 2),
                        baseY: y * baseSpacing + (Math.random() * jitter - jitter / 2),
                        offset: Math.random() * Math.PI * 2,
                    });
                }
            }
        }

        function draw(timestamp) {
            const time = timestamp * 0.00045;
            context.clearRect(0, 0, width, height);

            for (let i = 0; i < nodes.length; i += 1) {
                const current = nodes[i];
                const currentX = current.baseX + Math.sin(time + current.offset) * 9;
                const currentY = current.baseY + Math.cos(time * 1.1 + current.offset) * 9;

                for (let j = i + 1; j < nodes.length; j += 1) {
                    const next = nodes[j];
                    const nextX = next.baseX + Math.sin(time + next.offset) * 9;
                    const nextY = next.baseY + Math.cos(time * 1.1 + next.offset) * 9;

                    const dx = currentX - nextX;
                    const dy = currentY - nextY;
                    const distance = Math.hypot(dx, dy);

                    if (distance > 170) {
                        continue;
                    }

                    const pointerDistance = Math.hypot(pointer.x - (currentX + nextX) / 2, pointer.y - (currentY + nextY) / 2);
                    const pointerInfluence = pointerDistance < 220 ? 0.22 : 0;
                    const alpha = Math.max(0, 0.14 - distance / 1600 + pointerInfluence);

                    context.strokeStyle = `rgba(172, 152, 216, ${alpha})`;
                    context.lineWidth = 1;
                    context.beginPath();
                    context.moveTo(currentX, currentY);
                    context.lineTo(nextX, nextY);
                    context.stroke();
                }

                context.fillStyle = 'rgba(211, 198, 237, 0.5)';
                context.beginPath();
                context.arc(currentX, currentY, 1.6, 0, Math.PI * 2);
                context.fill();
            }

            rafId = window.requestAnimationFrame(draw);
        }

        function onPointerMove(event) {
            pointer.x = event.clientX;
            pointer.y = event.clientY;
        }

        resizeCanvas();
        rafId = window.requestAnimationFrame(draw);

        window.addEventListener('resize', resizeCanvas, { passive: true });
        window.addEventListener('pointermove', onPointerMove, { passive: true });

        window.addEventListener('beforeunload', () => {
            if (rafId) {
                window.cancelAnimationFrame(rafId);
            }
        });
    }
}

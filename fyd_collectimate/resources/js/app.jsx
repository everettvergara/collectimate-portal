import React from 'react';
import { createRoot } from 'react-dom/client';
import ReactFlowEditor from './components/ReactFlowEditor.jsx';

import './bootstrap.js';
import './custom.js';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import AOS from 'aos';
import 'aos/dist/aos.css';

document.addEventListener('DOMContentLoaded', function () {
    AOS.init();
});

const container = document.getElementById('reactflow-editor');
if (container) {
    const scriptId = container.dataset.scriptId;
    const root = createRoot(container);
    root.render(<ReactFlowEditor scriptId={scriptId} />);
}

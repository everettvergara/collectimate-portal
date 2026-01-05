import React, { useEffect } from 'react';
import ReactFlow, {
    Background,
    Controls,
    useNodesState,
    useEdgesState,
    addEdge
} from 'reactflow';
import 'reactflow/dist/style.css';
import axios from 'axios';

export default function ReactFlowEditor({ scriptId }) {
    // ReactFlow state hooks
    const [nodes, setNodes, onNodesChange] = useNodesState([]);
    const [edges, setEdges, onEdgesChange] = useEdgesState([]);

    // Load JSON from Laravel
    useEffect(() => {
        axios.get(`/api/reactflow/${scriptId}`).then(res => {
            const data = res.data;
            setNodes(data.nodes || []);
            setEdges(data.edges || []);
        });
    }, [scriptId]);

    // Add new node example
    const addNode = () => {
        const newNode = {
            id: (nodes.length + 1).toString(),
            position: { x: 250, y: 100 },
            data: { label: `Node ${nodes.length + 1}` },
        };
        setNodes(nds => [...nds, newNode]);
    };

    // Handle edge creation
    const onConnect = (params) => setEdges(eds => addEdge(params, eds));

    // Save back to Laravel
    const saveChanges = () => {
        axios.post(`/api/reactflow/${scriptId}`, { nodes, edges }).then(res => {
            if (res.data.redirect) {
                window.location.href = res.data.redirect;
            } else {
                alert('Saved!');
            }
        });
    };

    return (
        <div style={{ width: '100vw', height: '100vh' }}>
            <ReactFlow
                nodes={nodes}
                edges={edges}
                onNodesChange={onNodesChange}
                onEdgesChange={onEdgesChange}
                onConnect={onConnect}
                fitView
            >
                <Background />
                <Controls />
            </ReactFlow>

            <div style={{ position: 'absolute', top: 10, left: 10, zIndex: 10 }}>
                <button onClick={addNode}>Add Node</button>
                <button onClick={saveChanges}>Save</button>
            </div>
        </div>
    );
}

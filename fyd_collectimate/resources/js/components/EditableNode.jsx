// EditableNode.jsx
import React from 'react';

export default function EditableNode({ data }) {
    return (
        <div style={{ padding: 10, border: '1px solid #999', borderRadius: 4 }}>
            <input
                type="text"
                value={data.label}
                onChange={(e) => data.onChange(e.target.value)}
                style={{ width: '100%' }}
            />
        </div>
    );
}

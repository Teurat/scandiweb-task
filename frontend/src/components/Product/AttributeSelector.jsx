import kebabCase from '../../utils/kebabCase';

export default function AttributeSelector({ attr, selected, onSelect }) {
  if (!attr || !Array.isArray(attr.values)) return null;

  return (
    <div
      data-testid={`product-attribute-${kebabCase(attr.label || 'unknown')}`}
      className="space-y-2"
    >
      <p className="text-xs font-semibold uppercase text-gray-700">
        {attr.label}:
      </p>

      <div className="flex gap-3 flex-wrap">
        {attr.values.map((item) => {
          const isSelected = selected === item.value;
          const baseId = `product-attribute-${kebabCase(attr.label)}-${item.value}`;

          return (
            <button
              key={item.id || `${item.value}-${item.displayValue}`}
              data-testid={baseId + (isSelected ? '-selected' : '')}
              onClick={() => onSelect(item.value)}
              className={
                attr.type === 'swatch'
                  ? `w-10 h-10 border rounded-sm transition ${
                      isSelected ? 'ring-2 ring-[#5ECE7B]' : 'hover:ring-2 hover:ring-gray-400'
                    }`
                  : `w-12 h-10 flex items-center justify-center border text-sm font-medium rounded-sm transition ${
                      isSelected
                        ? 'bg-gray-900 text-white'
                        : 'bg-white text-gray-700 hover:bg-gray-100'
                    }`
              }
              style={
                attr.type === 'swatch'
                  ? { backgroundColor: item.value }
                  : undefined
              }
            >
              {attr.type === 'text' && item.value}
            </button>
          );
        })}
      </div>
    </div>
  );
}

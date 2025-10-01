import { useParams } from 'react-router-dom';
import { useQuery } from '@apollo/client';
import { GET_PRODUCTS_BY_CATEGORY } from '../graphql/queries';
import ProductCard from '../components/Product/ProductCard';
import { NoDataFound } from '../components/NoDataFound';

export default function CategoryPage() {
  const { name } = useParams();
  const { data, loading, error } = useQuery(GET_PRODUCTS_BY_CATEGORY, {
    variables: { category: name },
  });

  if (loading) return <p>Loading…</p>;
  if (error) return <p>Error: {error.message}</p>;

  const products = data?.products || [];
  if (!products?.length) return <NoDataFound />;

  return (
    <section className="mx-16">
      <h1 className="font-raleway text-[42px] font-normal leading-[160%] my-12 capitalize">
        {name}
      </h1>

      <div className="grid grid-cols-3 gap-x-16 gap-y-20">
        {products.map((p) => (
          <ProductCard key={p.id} product={p} />
        ))}
      </div>
    </section>
  );
}

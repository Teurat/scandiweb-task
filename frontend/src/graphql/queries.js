import { gql } from '@apollo/client';

export const GET_CATEGORIES = gql`
  query {
    categories {
      name
    }
  }
`;

export const GET_PRODUCTS_BY_CATEGORY = gql`
  query ($category: String) {
    products(category: $category) {
      id
      name
      inStock
      gallery
      prices {
        amount
        currency {
          code
          symbol
        }
      }
      attributes {
        label
        type
        values {
          display
          value
          id
        }
      }
    }
  }
`;

export const GET_PRODUCT = gql`
  query ($id: ID!) {
    product(id: $id) {
      id
      name
      inStock
      gallery
      description
      prices {
        amount
        currency {
          code
          symbol
        }
      }
      attributes {
        label
        type
        values {
          display
          value
          id
        }
      }
    }
  }
`;
